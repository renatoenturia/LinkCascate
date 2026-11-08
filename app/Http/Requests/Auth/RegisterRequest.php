<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * Request de cadastro: validação e criação do usuário.
 *
 * Gerado com: php artisan make:request Auth/RegisterRequest
 *
 * @property-read string $name
 * @property-read string $email
 * @property-read string $email_confirmation
 * @property-read string $password
 * @property-read string $password_confirmation
 */
class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'confirmed', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', $this->passwordRules()],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Informe seu nome.',
            'name.max' => 'O nome não pode ter mais de :max caracteres.',
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um endereço de e-mail válido.',
            'email.confirmed' => 'A confirmação do e-mail não confere.',
            'email.unique' => 'Este e-mail já está em uso.',
            'email.max' => 'O e-mail não pode ter mais de :max caracteres.',
            'password.required' => 'Informe uma senha.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'password.letters' => 'A senha deve conter pelo menos uma letra.',
            'password.mixed' => 'A senha deve conter letras maiúsculas e minúsculas.',
            'password.numbers' => 'A senha deve conter pelo menos um número.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'email' => 'e-mail',
            'email_confirmation' => 'confirmação do e-mail',
            'password' => 'senha',
            'password_confirmation' => 'confirmação da senha',
        ];
    }

    /**
     * Cria o usuário apenas com atributos validados (sem confirmações nem campos extras).
     */
    public function tryToRegister(): User
    {
        return User::query()->create(
            $this->safe()->only(['name', 'email', 'password'])
        );
    }

    protected function passwordRules(): Password
    {
        return Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers();
    }
}
