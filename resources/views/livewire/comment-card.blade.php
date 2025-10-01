<?php

declare(strict_types=1);

?>

<x-card :elevation="2" @class(['hover:border-outline-low space-y-4', $isReply ? 'border-none' : ''])>
    <div class="flex items-center">
        <div class="flex flex-grow flex-row gap-2">
            <x-avatar :model="$comment->author" :fi-avatar="true" alt="{{$comment->author->name}}" />

            <div class="text-2xs text-text-medium flex items-center gap-1">
                <p>
                    @
                    <span></span>
                    {{ $comment->author->name }}
                </p>
                <span>&bull;</span>
                <span>{{ $comment->created_at->diffForHumans() }}</span>
            </div>
        </div>

        @auth
            @if (\Illuminate\Support\Facades\Auth::user()->is_admin || $comment->author->is(\Illuminate\Support\Facades\Auth::user()))
                <x-filament::icon-button wire:click.prevent="delete" icon="heroicon-o-trash" size="sm" color="danger" />
            @endif
        @endauth
    </div>

    <div class="space-y-2">
        <div class="prose prose-sm prose-invert text-text-medium text-2xs line-clamp-5">
            {!! Str::markdown($comment->body) !!}
        </div>
    </div>

    <div class="mt-6 flex items-center gap-8">
        @if (! $isReply)
            <x-filament::icon-button
                wire:click.prevent="toggleReplies"
                icon="heroicon-o-chat-bubble-oval-left"
                size="sm"
                color="gray"
            />
            <span class="text-icon-medium">{{ $replies }}</span>
        @endif

        <x-filament::icon-button
            wire:click.prevent="upvote"
            icon="heroicon-o-hand-thumb-up"
            size="sm"
            color="{{ $userVote === 1 ? 'success' : 'gray'}}"
        />
        <span class="text-icon-medium">{{ $comment->votes }}</span>
        <x-filament::icon-button
            wire:click.prevent="downvote"
            icon="heroicon-o-hand-thumb-down"
            size="sm"
            color="{{ $userVote === -1 ? 'danger' : 'gray'}}"
        />
        @if (! $isReply)
            <button class="text-text-low cursor-pointer text-xs" wire:click.prevent="toggleReplyForm">Responder</button>
        @endif
    </div>

    @if ($showReplyForm)
        <div>
            <livewire:comment-form :commentable="$comment" wire:key="reply-form-for-{{ $comment->id }}" />
        </div>
    @endif

    @if ($showReplies)
        <div class="space-y-4">
            @forelse ($this->comment->replies as $reply)
                <livewire:comment-card :isReply="true" :comment="$reply" wire:key="comment-reply-{{ $reply->id }}" />
            @empty
                
            @endforelse
        </div>
    @endif
</x-card>

<?php
