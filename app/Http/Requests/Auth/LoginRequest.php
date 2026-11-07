<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Request de login: validação, rate limit e autenticação.
 *
 * O controller só orquestra HTTP (sessão e redirect). Validação e regras
 * de negócio do login ficam aqui — padrão Form Request do Laravel.
 *
 * Gerado com: php artisan make:request Auth/LoginRequest
 *
 * @property-read string $email      E-mail informado no formulário (validado)
 * @property-read string $password  Senha informada no formulário (validada)
 * @property-read bool $remember    "Lembrar de mim" (opcional)
 */
class LoginRequest extends FormRequest
{
    /**
     * Rotas públicas de login não exigem usuário autenticado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras executadas automaticamente antes do método do controller.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Mensagens amigáveis exibidas na view via $errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais de :max caracteres.',
            'password.required' => 'Informe sua senha.',
            'password.max' => 'A senha não pode ter mais de :max caracteres.',
        ];
    }

    /**
     * Nomes dos campos substituídos em mensagens padrão do validador.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'email' => 'e-mail',
            'password' => 'senha',
        ];
    }

    /**
     * Credenciais já validadas, seguras para uso em Auth::attempt.
     *
     * @return array{email: string, password: string}
     */
    public function credentials(): array
    {
        return $this->safe()->only(['email', 'password']);
    }

    /**
     * Autentica o usuário ou lança ValidationException (flash de erros).
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->credentials(), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'E-mail ou senha incorretos.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * @throws ValidationException
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => sprintf(
                'Muitas tentativas de login. Tente novamente em %d %s.',
                $seconds >= 60 ? (int) ceil($seconds / 60) : $seconds,
                $seconds >= 60 ? 'minuto(s)' : 'segundo(s)',
            ),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
