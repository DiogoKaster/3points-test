<?php

declare(strict_types=1);

?>
@props([
    'icon',
    'label',
    'value',
])

@use(Illuminate\Support\Number)

<x-card class="flex h-28 items-center gap-4 border-indigo-600 hover:border-indigo-500">
    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600 p-2">
        <x-dynamic-component :component="'heroicon-' . $icon" class="h-8 w-8 text-white" />
    </div>
    <div class="flex flex-col justify-center">
        <p class="text-text-medium text-xs">{{ $label }}</p>

        <p class="text-sm font-bold">{{ Number::format((int) $value) }}</p>
    </div>
</x-card>
<?php 
