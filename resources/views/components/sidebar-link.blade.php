<?php

declare(strict_types=1);

?>

@props([
    'href',
    'icon',
])

<a
    href="{{ $href }}"
    class="hover:bg-elevation-02dp hover:outline-helper-outline flex items-center gap-4 rounded-lg p-4 hover:outline"
>
    <x-dynamic-component :component="'heroicon-o-'.$icon" class="text-icon-medium h-6 w-6" />

    <p class="text-text-medium text-xs">
        {{ $slot }}
    </p>
</a>

<?php
