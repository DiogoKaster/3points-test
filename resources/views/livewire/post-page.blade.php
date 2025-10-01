<?php

declare(strict_types=1);

?>

@php
    $postAuthorAvatarUrl = $post->author->getFilamentAvatarUrl();
@endphp

<div class="space-y-8">
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

    <div class="space-y-2">
        <x-title>
            {{ $post->title }}
        </x-title>
        <div class="prose prose-sm prose-invert text-text-medium text-2xs">
            {!! Str::markdown($post->body) !!}
        </div>
    </div>

    <div>
        <livewire:comment-form :commentable="$post" wire:key="comment-form-{{ $post->id }}" />
    </div>

    <x-card class="space-y-8">
        <x-title>Todas as respostas</x-title>

        @forelse ($comments as $comment)
            <livewire:comment-card :comment="$comment" wire:key="comment-{{ $comment->id }}" />
        @empty
            <x-card :elevation="2" class="border-dashed text-center">
                <p class="text-text-medium">Ainda não há comentários neste post. Seja o primeiro!</p>
            </x-card>
        @endforelse

        <div class="mt-8">
            {{ $comments->links() }}
        </div>
    </x-card>
</div>

<?php
