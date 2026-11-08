<?php

namespace App\Http\Requests;

use App\Models\Link;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $title
 * @property-read string $url
 * @property-read int|null $position
 * @property-read bool|null $is_active
 */
class UpdateLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        $link = $this->route('link');

        return $link instanceof Link
            && $this->user()?->can('update', $link) === true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'url', 'max:2048'],
            'position' => ['sometimes', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Informe um título para o link.',
            'title.max' => 'O título não pode ter mais de :max caracteres.',
            'url.required' => 'Informe a URL de destino.',
            'url.url' => 'Informe uma URL válida (incluindo https://).',
            'url.max' => 'A URL não pode ter mais de :max caracteres.',
            'position.integer' => 'A posição deve ser um número inteiro.',
            'position.min' => 'A posição não pode ser negativa.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'título',
            'url' => 'URL',
            'position' => 'posição',
            'is_active' => 'ativo',
        ];
    }

    public function tryToUpdateLink(Link $link): Link
    {
        $data = $this->safe()->only(['title', 'url', 'position']);

        $data['is_active'] = $this->boolean('is_active');

        $link->update($data);

        return $link->refresh();
    }
}
