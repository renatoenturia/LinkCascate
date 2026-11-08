<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

/**
 * Valida o identificador público no formato @usuario (sem espaços; slug com letras, números, _ e -).
 */
class HandlerFormat implements ValidationRule
{
    private const int MIN_SLUG_LENGTH = 3;

    private const int MAX_SLUG_LENGTH = 30;

    private const string SLUG_PATTERN = '/^[a-zA-Z0-9_-]+$/';

    /**
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('O identificador deve ser um texto.');

            return;
        }

        if (preg_match('/\s/u', $value) === 1) {
            $fail('O identificador não pode conter espaços.');

            return;
        }

        if (! str_starts_with($value, '@')) {
            $fail('O identificador deve começar com @.');

            return;
        }

        $slug = substr($value, 1);

        if ($slug === '') {
            $fail('Informe um nome após o @.');

            return;
        }

        if (strlen($slug) < self::MIN_SLUG_LENGTH) {
            $fail('O identificador deve ter pelo menos '.self::MIN_SLUG_LENGTH.' caracteres após o @.');

            return;
        }

        if (strlen($slug) > self::MAX_SLUG_LENGTH) {
            $fail('O identificador não pode ter mais de '.self::MAX_SLUG_LENGTH.' caracteres após o @.');

            return;
        }

        if (preg_match(self::SLUG_PATTERN, $slug) !== 1) {
            $fail('Após o @, use apenas letras, números, sublinhado (_) e hífen (-).');
        }
    }
}
