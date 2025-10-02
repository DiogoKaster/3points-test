<?php

declare(strict_types=1);

?>

<x-card :elevation="2" class="hover:outline-text-low cursor-pointer space-y-4" wire:click.prevent="showPost">
    <div class="flex items-center justify-between">
        <div class="flex gap-2">
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
            wire:click.stop.prevent="toggleReplies"
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
        <button
            class="text-text-low hover:text-text-medium cursor-pointer text-xs"
            wire:click.stop.prevent="toggleReplyForm"
        >
            Responder
        </button>
    </div>

    @if ($showReplies)
        <div class="space-y-4">
            @forelse ($this->post->comments()->latest()->get() as $comment)
                <livewire:comment-card
                    :isReply="true"
                    :comment="$comment"
                    wire:key="comment-reply-{{ $comment->id }}"
                />
            @empty
                <x-card :elevation="2" class="border-dashed text-center">
                    <p class="text-text-medium">Sem comentários!</p>
                </x-card>
            @endforelse
        </div>
    @endif

    @if ($showReplyForm)
        <div>
            <livewire:comment-form :commentable="$post" wire:key="reply-form-for-{{ $post->id }}" />
        </div>
    @endif
</x-card>

<?php
