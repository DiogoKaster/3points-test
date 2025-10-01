<?php

declare(strict_types=1);

?>

<x-card :elevation="2" class="hover:border-outline-low cursor-pointer space-y-4" wire:click.prevent="showPost">
    <div class="flex items-center">
        <div class="flex flex-grow flex-row gap-2">
            <x-avatar :model="$post->author" :fi-avatar="true" alt="{{$post->author->name}}" />

            <div class="space-y-1">
                <div class="text-2xs text-text-medium flex items-center gap-1">
                    <p>
                        @
                        <span></span>
                        {{ $post->author->name }}
                    </p>
                    <span>&bull;</span>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <span class="text-3xs text-neutral-neutral">/c/{{ $post->community->slug }}</span>
            </div>
        </div>

        @auth
            @if (\Illuminate\Support\Facades\Auth::user()->is_admin || $post->author->is(\Illuminate\Support\Facades\Auth::user()))
                <x-filament::icon-button
                    wire:click.stop.prevent="delete"
                    icon="heroicon-o-trash"
                    size="sm"
                    color="danger"
                />
            @endif
        @endauth
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
