<?php

namespace App\Http\Requests;

use App\Models\Link;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $title
 * @property-read string $url
 * @property-read bool|null $is_active
 */
class StoreLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', Link::class) ?? false;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'url', 'max:2048'],
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
            'is_active' => 'ativo',
        ];
    }

    public function tryToCreateLink(): Link
    {
        $user = $this->user();

        $nextPosition = ((int) $user->links()->max('position')) + 1;

        $attributes = $this->safe()->only(['title', 'url']);
        $attributes['position'] = $nextPosition;
        $attributes['is_active'] = $this->boolean('is_active');

        return $user->links()->create($attributes);
    }
}
