<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\HandlerFormat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read string $name
 * @property-read string $handler      Valor com @ (ex.: @renato)
 * @property-read string $handler_slug Slug sem @ (normalizado em prepareForValidation)
 * @property-read string|null $bio
 */
class StoreProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        $raw = $this->input('handler');

        if (! is_string($raw)) {
            return;
        }

        $trimmed = trim($raw);

        if ($trimmed !== '' && ! str_starts_with($trimmed, '@')) {
            $trimmed = '@'.$trimmed;
        }

        $this->merge([
            'handler' => $trimmed,
            'handler_slug' => ltrim($trimmed, '@'),
        ]);
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'handler' => ['required', 'string', new HandlerFormat],
            'handler_slug' => [
                'required',
                'string',
                Rule::unique('users', 'handler')->ignore($this->user()),
            ],
            'bio' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Informe seu nome de exibição.',
            'handler.required' => 'Escolha um handler para sua página pública.',
            'handler_slug.unique' => 'Este handler já está em uso.',
            'bio.max' => 'O resumo não pode ter mais de :max caracteres.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'handler' => 'handler',
            'bio' => 'biografia',
        ];
    }

    public function updateProfile(User $user): User
    {
        $user->update([
            'name' => $this->validated('name'),
            'handler' => $this->validated('handler_slug'),
            'bio' => $this->validated('bio'),
        ]);

        return $user->refresh();
    }
}
