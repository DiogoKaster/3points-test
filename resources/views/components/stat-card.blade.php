<?php

declare(strict_types=1);

?>

@props([
    'icon',
    'label',
    'value',
    'color' => 'brand',
])

@php
    $colorClasses = match ($color) {
        'lime' => [
            'bg' => 'bg-lime-primary',
            'border' => 'border-lime-primary/30',
            'hover' => 'hover:border-lime-primary/50',
            'gradient_from' => 'from-lime-primary/5',
        ],
        'indigo' => [
            'bg' => 'bg-indigo-600',
            'border' => 'border-indigo-600/30',
            'hover' => 'hover:border-indigo-600/50',
            'gradient_from' => 'from-indigo-600/10',
        ],
        default => [
            'bg' => 'bg-brand-primary',
            'border' => 'border-brand-primary/30',
            'hover' => 'hover:border-brand-primary/50',
            'gradient_from' => 'from-brand-primary/10',
        ],
    };
@endphp

<div
    @class([
        'flex h-28 items-center gap-4 rounded-xl border p-4 transition hover:scale-[1.01] md:p-6',
        'to-elevate-surface bg-gradient-to-r',
        $colorClasses['gradient_from'],
        $colorClasses['border'],
        $colorClasses['hover'],
    ])
>
    <div @class(['flex h-10 w-10 items-center justify-center rounded-lg p-2 text-white', $colorClasses['bg']])>
        <x-dynamic-component :component="'heroicon-' . $icon" class="h-8 w-8" />
    </div>
    <div class="flex flex-col justify-center">
        <p class="text-text-medium text-xs">{{ $label }}</p>

        <p class="text-sm font-bold">{{ \Illuminate\Support\Number::format((int) $value) }}</p>
    </div>
</div>
