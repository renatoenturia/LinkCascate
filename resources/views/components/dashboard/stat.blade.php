@props([
    'label',
    'value',
    'icon',
])

<div {{ $attributes->class([
    'flex items-center gap-3 rounded-box border border-base-300 bg-base-100 p-4',
]) }}>
    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-base-200 text-primary">
        <x-icon :name="$icon" class="!h-5 !w-5" />
    </div>
    <div class="min-w-0 flex-1">
        <p class="text-xs font-medium uppercase tracking-wide opacity-60">{{ $label }}</p>
        <p class="truncate text-xl font-semibold tabular-nums leading-tight">{{ $value }}</p>
    </div>
</div>
