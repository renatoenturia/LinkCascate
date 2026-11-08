@php
    $link = $link ?? null;
@endphp

<div class="space-y-4">
    <x-input label="Título" name="title" :value="$link?->title" required autofocus />
    <x-input label="URL" name="url" type="url" :value="$link?->url" placeholder="https://" />

    @isset($link)
        <x-input label="Posição na cascata" name="position" type="number" :value="$link->position" min="0" />
    @endisset

    <x-form.checkbox
        label="Link visível na página pública"
        name="is_active"
        unset-value="0"
        :checked="$link?->is_active ?? true"
    />
</div>
