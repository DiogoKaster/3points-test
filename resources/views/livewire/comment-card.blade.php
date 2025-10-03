<?php

declare(strict_types=1);

?>

@php
    $isAuthor = $comment->post->author->is($comment->author);
@endphp

<x-card :elevation="2" @class(['hover:outline-text-low space-y-4', $isReply ? 'outline-none' : ''])>
    <div class="flex items-center justify-between gap-2">
        <div class="flex gap-2">
            <x-avatar :model="$comment->author" :fi-avatar="true" alt="{{$comment->author->name}}" />
            <div class="text-text-high flex items-center gap-4 text-xs">
                <p>{{ $comment->author->name }}</p>
                <span class="text-3xs text-text-medium">{{ $comment->created_at->diffForHumans() }}</span>
                @if ($isAuthor)
                    <span
                        class="text-3xs text-brand-primary border-brand-primary/50 bg-brand-primary/10 rounded-md border px-2 py-0.5 font-semibold"
                    >
                        Autor
                    </span>
                @else
                    <span
                        class="text-3xs rounded-md border border-green-600/50 bg-green-600/10 px-2 py-0.5 font-semibold text-green-600"
                    >
                        Resposta
                    </span>
                @endif
            </div>
        </div>

        @auth
            @if (\Illuminate\Support\Facades\Auth::user()->is_admin || $comment->author->is(\Illuminate\Support\Facades\Auth::user()))
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
        <div class="prose prose-sm prose-invert text-text-medium text-2xs line-clamp-5">
            {!! Str::markdown($comment->body) !!}
        </div>
    </div>

    <div class="mt-6 flex flex-wrap items-center gap-8">
        <x-filament::icon-button
            wire:click.stop.prevent="toggleReplies"
            icon="heroicon-o-chat-bubble-oval-left"
            size="sm"
            color="gray"
        />

        <span class="text-icon-medium">{{ $replies }}</span>

        <x-filament::icon-button
            wire:click.stop.prevent="upvote"
            icon="heroicon-o-hand-thumb-up"
            size="sm"
            color="{{ $userVote === 1 ? 'success' : 'gray'}}"
        />

        <span class="text-icon-medium">{{ $comment->votes }}</span>

        <x-filament::icon-button
            wire:click.stop.prevent="downvote"
            icon="heroicon-o-hand-thumb-down"
            size="sm"
            color="{{ $userVote === -1 ? 'danger' : 'gray'}}"
        />

        <button
            class="text-text-low hover:text-text-medium cursor-pointer text-xs"
            wire:click.prevent="toggleReplyForm"
        >
            Responder
        </button>
    </div>

    @if ($showReplies)
        <div class="space-y-4">
            @forelse ($this->comment->replies as $reply)
                <livewire:comment-card :isReply="true" :comment="$reply" wire:key="comment-reply-{{ $reply->id }}" />
            @empty
                <x-card :elevation="2" class="border-dashed text-center">
                    <p class="text-text-medium">Sem comentários!</p>
                </x-card>
            @endforelse
        </div>
    @endif

    @if ($showReplyForm)
        <div>
            <livewire:comment-form :commentable="$comment" wire:key="reply-form-for-{{ $comment->id }}" />
        </div>
    @endif
</x-card>

<?php
