<?php

declare(strict_types=1);

?>
@props([
    'community',
])

@php
    $avatarUrl = $community->getFirstMediaUrl('avatar');
@endphp

<a href="{{ route('communities.index') }}" class="block">
    <x-card :elevation="2">
        <div class="flex items-center space-x-4">
            @if ($avatarUrl)
                <img
                    src="{{ $avatarUrl }}"
                    alt="avatar {{ $community->name }}"
                    class="h-12 w-12 rounded-full object-cover"
                />
            @else
                <x-heroicon-o-user-circle class="text-text-medium h-12 w-12" />
            @endif

            <div>
                <x-title>
                    {{ $community->name }}
                </x-title>
                <p class="text-text-medium text-xs">c/{{ $community->slug }}</p>
            </div>
        </div>
    </x-card>
</a>
<?php 
