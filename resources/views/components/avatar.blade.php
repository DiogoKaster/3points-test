<?php

declare(strict_types=1);

?>

@props([
    'collection',
    'model',
    'fiAvatar' => false,
    'size' => 'sm',
    'alt',
])

@php
    $sizeClasses = match ($size) {
        'lg' => 'h-16 w-16',
        'md' => 'h-12 w-12',
        'xs' => 'h-6 w-6',
        '2xs' => 'h-4 w-4',
        default => 'h-8 w-8',
    };

    $avatarUrl = null;
    if ($fiAvatar) {
        $avatarUrl = $model?->getFilamentAvatarUrl();
    } else {
        $avatarUrl = $model->getFirstMediaUrl($collection);
    }
@endphp

@if ($avatarUrl)
    <img
        src="{{ $avatarUrl }}"
        alt="avatar {{ $alt }}"
        @class([
            'rounded-full object-cover',
            $sizeClasses,
        ])
    />
@else
    <x-heroicon-o-user-circle @class([
        'text-text-medium',
        $sizeClasses,
    ]) />
@endif

<?php
