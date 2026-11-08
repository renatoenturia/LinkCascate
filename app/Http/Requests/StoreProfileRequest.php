<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read string $name
 * @property-read string $handler
 * @property-read string|null $bio
 */
class StoreProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'handler' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-zA-Z0-9_-]+$/',
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
            'handler.unique' => 'Este handler já está em uso.',
            'handler.regex' => 'Use apenas letras, números, hífen e sublinhado.',
            'handler.min' => 'O handler deve ter pelo menos :min caracteres.',
            'handler.max' => 'O handler não pode ter mais de :max caracteres.',
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
        $user->update(
            $this->safe()->only(['name', 'handler', 'bio'])
        );

        return $user->refresh();
    }
}
