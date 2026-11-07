@php
    $link = $link ?? null;
@endphp

<div class="space-y-4">
    <div>
        <label for="title" class="mb-1 block text-sm font-medium text-gray-700">Título</label>
        <input
            id="title"
            type="text"
            name="title"
            value="{{ old('title', $link?->title) }}"
            required
            autofocus
            aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}"
            @class([
                'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-1',
                'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('title'),
                'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('title'),
            ])
        >
        @error('title')
            <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="url" class="mb-1 block text-sm font-medium text-gray-700">URL</label>
        <input
            id="url"
            type="url"
            name="url"
            value="{{ old('url', $link?->url) }}"
            placeholder="https://"
            aria-invalid="{{ $errors->has('url') ? 'true' : 'false' }}"
            @class([
                'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-1',
                'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('url'),
                'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('url'),
            ])
        >
        @error('url')
            <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
        @enderror
    </div>

    @isset($link)
        <div>
            <label for="position" class="mb-1 block text-sm font-medium text-gray-700">Posição na cascata</label>
            <input
                id="position"
                type="number"
                name="position"
                min="0"
                value="{{ old('position', $link->position) }}"
                aria-invalid="{{ $errors->has('position') ? 'true' : 'false' }}"
                @class([
                    'w-full rounded-md border px-3 py-2 focus:outline-none focus:ring-1',
                    'border-red-500 focus:border-red-500 focus:ring-red-500' => $errors->has('position'),
                    'border-gray-300 focus:border-blue-500 focus:ring-blue-500' => ! $errors->has('position'),
                ])
            >
            @error('position')
                <p class="mt-1 text-sm text-red-600" role="alert">{{ $message }}</p>
            @enderror
        </div>
    @endisset

    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input
            id="is_active"
            type="checkbox"
            name="is_active"
            value="1"
            class="rounded border-gray-300"
            @checked(old('is_active', $link?->is_active ?? true))
        >
        <label for="is_active" class="text-sm text-gray-700">Link visível na página pública</label>
    </div>
    @error('is_active')
        <p class="text-sm text-red-600" role="alert">{{ $message }}</p>
    @enderror
</div>
