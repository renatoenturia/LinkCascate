<?php

namespace Tests\Unit;

use App\Rules\HandlerFormat;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class HandlerFormatRuleTest extends TestCase
{
    public function test_accepts_valid_handler_with_at_prefix(): void
    {
        $this->assertTrue($this->validate('@renato_dev-99'));
    }

    public function test_rejects_missing_at_prefix(): void
    {
        $errors = $this->validateWithErrors('renato');
        $this->assertContains('O handler deve começar com @.', $errors);
    }

    public function test_rejects_spaces(): void
    {
        $errors = $this->validateWithErrors('@meu nome');
        $this->assertContains('O handler não pode conter espaços.', $errors);
    }

    public function test_rejects_invalid_characters_after_at(): void
    {
        $errors = $this->validateWithErrors('@user.name');
        $this->assertContains('Após o @, use apenas letras, números, sublinhado (_) e hífen (-).', $errors);
    }

    private function validate(string $value): bool
    {
        return Validator::make(
            ['handler' => $value],
            ['handler' => ['required', new HandlerFormat]]
        )->passes();
    }

    /**
     * @return list<string>
     */
    private function validateWithErrors(string $value): array
    {
        $validator = Validator::make(
            ['handler' => $value],
            ['handler' => ['required', new HandlerFormat]]
        );

        return $validator->errors()->all();
    }
}
