<?php

declare(strict_types=1);

?>

@php
    $coverUrl = $community->getFirstMediaUrl('covers');
    $communityAvatarUrl = $community->getFirstMediaUrl('avatars');
@endphp

<div class="space-y-4 md:space-y-8">
    @if ($coverUrl)
        <img class="h-52 w-full" src="{{ $coverUrl }}" alt="cover {{ $community->name }}" />
    @endif

    <div class="flex gap-4">
        @if ($communityAvatarUrl)
            <img
                src="{{ $communityAvatarUrl }}"
                alt="avatar {{ $community->name }}"
                class="h-16 w-16 rounded-full object-cover"
            />
        @else
            <x-heroicon-o-user-circle class="text-text-medium h-16 w-16" />
        @endif

        <div class="space-y-4">
            <h1 class="font-family-secondary text-md">/c/ {{ $community->name }}</h1>
            <p class="text-text-medium text-xs">{{ $community->description }}</p>

            <div class="text-text-high flex items-center gap-4 text-xs">
                <div class="flex items-center gap-1.5">
                    <x-heroicon-o-users class="h-6 w-6" />
                    <span>{{ $community->members_count }} membros</span>
                </div>

                <div class="flex items-center gap-1.5">
                    <x-heroicon-o-users class="h-6 w-6" />
                    <span>Criada em {{ $community->created_at->translatedFormat('M, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <x-card class="space-y-8">
        <x-title>Veja todos os posts da comunidade</x-title>

        @forelse ($posts as $post)
            <livewire:post-card :post="$post" wire:key="post-{{ $post->id }}" />
        @empty
            <x-card :elevation="2" class="border-dashed text-center">
                <p class="text-text-medium">Ainda não há posts nesta comunidade. Seja o primeiro!</p>
            </x-card>
        @endforelse
    </x-card>
</div>

<?php
