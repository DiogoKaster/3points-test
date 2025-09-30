<?php

declare(strict_types=1);

?>
@props([
    'href',
    'icon',
])

<a
    href="{{ $href }}"
    class="hover:bg-elevation-02dp hover:outline-outline-dark flex items-center gap-4 rounded-lg p-4 hover:outline"
>
    <x-dynamic-component :component="'heroicon-o-'.$icon" class="text-icon-medium h-5 w-5" />

    <p class="text-text-medium text-xs">
        {{ $slot }}
    </p>
</a>
<?php 
