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
            @php
                $postAuthorAvatarUrl = $post->author->getFilamentAvatarUrl();
            @endphp

            <x-card :elevation="2" class="space-y-4">
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
                    <p class="text-text-medium line-clamp-5">
                        {!! Str::markdown($post->body) !!}
                    </p>
                </div>

                <div class="mt-6 flex items-center gap-10">
                    <x-heroicon-o-chat-bubble-oval-left
                        class="text-icon-medium hover:text-icon-high h-5 w-5 cursor-pointer"
                    />
                    <x-heroicon-o-hand-thumb-up class="text-icon-medium hover:text-icon-high h-5 w-5 cursor-pointer" />
                    <x-heroicon-o-hand-thumb-down
                        class="text-icon-medium hover:text-icon-high h-5 w-5 cursor-pointer"
                    />
                </div>
            </x-card>
        @empty
            <x-card :elevation="2" class="border-dashed text-center">
                <p class="text-text-medium">Ainda não há posts nesta comunidade. Seja o primeiro!</p>
            </x-card>
        @endforelse
    </x-card>
</div>
<?php 
