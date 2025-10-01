<?php

declare(strict_types=1);

?>

@php
    $postAuthorAvatarUrl = $post->author->getFilamentAvatarUrl();
@endphp

<x-card :elevation="2" class="hover:border-outline-low cursor-pointer space-y-4" wire:click.prevent="showPost">
    <div class="flex items-center gap-2">
        @if ($postAuthorAvatarUrl)
            <img
                src="{{ $postAuthorAvatarUrl }}"
                alt="avatar {{ $post->author->name }}"
                class="h-8 w-8 rounded-full object-cover"
            />
        @else
            <x-heroicon-o-user-circle class="text-text-medium h-8 w-8" />
        @endif

        <div class="text-2xs text-text-medium flex items-center gap-1">
            <p>
                @
                <span></span>
                {{ $post->author->name }}
            </p>
            <span>&bull;</span>
            <span>{{ $post->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <div class="space-y-2">
        <x-title>
            {{ $post->title }}
        </x-title>
        <div class="prose prose-sm prose-invert text-text-medium text-2xs line-clamp-5">
            {!! Str::markdown($post->body) !!}
        </div>
    </div>

    <div class="mt-6 flex items-center gap-8">
        <x-filament::icon-button
            wire:click.prevent="showPost"
            icon="heroicon-o-chat-bubble-oval-left"
            size="sm"
            color="gray"
        />
        <span class="text-icon-medium">{{ $post->comments()->whereNull('parent_id')->count() }}</span>
        <x-filament::icon-button
            wire:click.stop.prevent="upvote"
            icon="heroicon-o-hand-thumb-up"
            size="sm"
            color="{{ $userVote === 1 ? 'success' : 'gray'}}"
        />
        <span class="text-icon-medium">{{ $post->votes }}</span>
        <x-filament::icon-button
            wire:click.stop.prevent="downvote"
            icon="heroicon-o-hand-thumb-down"
            size="sm"
            color="{{ $userVote === -1 ? 'danger' : 'gray'}}"
        />
    </div>
</x-card>

<?php
