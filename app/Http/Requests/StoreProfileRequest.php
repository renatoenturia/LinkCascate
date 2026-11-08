<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\HandlerFormat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

/**
 * @property-read string $name
 * @property-read string $handler
 * @property-read string $handler_slug
 * @property-read string|null $bio
 * @property-read UploadedFile|null $avatar
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
            'avatar' => [
                'nullable',
                File::types(['jpg', 'jpeg', 'png', 'webp'])
                    ->max(2048),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Informe seu nome de exibição.',
            'handler.required' => 'Escolha um identificador para sua página pública.',
            'handler_slug.unique' => 'Este identificador já está em uso.',
            'bio.max' => 'O resumo não pode ter mais de :max caracteres.',
            'avatar.image' => 'O arquivo deve ser uma imagem.',
            'avatar.mimes' => 'Use JPG, PNG ou WebP.',
            'avatar.max' => 'A imagem não pode ter mais de 2 MB.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'handler' => 'identificador',
            'bio' => 'biografia',
            'avatar' => 'foto de perfil',
        ];
    }

    public function updateProfile(User $user): User
    {
        $attributes = [
            'name' => $this->validated('name'),
            'handler' => $this->validated('handler_slug'),
            'bio' => $this->validated('bio'),
        ];

        if ($this->hasFile('avatar')) {
            if ($user->avatar_path !== null) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $attributes['avatar_path'] = $this->file('avatar')->store('avatars', 'public');
        }

        $user->update($attributes);

        return $user->refresh();
    }
}
