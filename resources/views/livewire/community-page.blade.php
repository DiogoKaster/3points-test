<?php

declare(strict_types=1);

?>

@php
    $coverUrl = $community->getFirstMediaUrl('covers');
@endphp

<div class="space-y-4 md:space-y-8">
    @if ($coverUrl)
        <img class="h-52 w-full" src="{{ $coverUrl }}" alt="cover {{ $community->name }}" />
    @endif

    <div class="flex flex-col items-start gap-8 md:flex-row md:items-center md:justify-between">
        <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center">
            <x-avatar collection="avatars" :model="$community" alt="{{$community->name}}" size="lg" />

            <div class="space-y-4">
                <h1 class="font-family-secondary text-md">/c/ {{ $community->name }}</h1>
                <p class="text-text-medium text-xs">{{ $community->description }}</p>

                <div class="text-text-high flex flex-col gap-8 text-xs sm:flex-row sm:items-center">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-users class="h-6 w-6" />
                        <span>{{ $community->members_count }} membros</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <x-heroicon-o-users class="h-6 w-6" />
                        <span>Criada em {{ $community->created_at->translatedFormat('M, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex w-full min-w-fit flex-col items-center gap-8 sm:w-auto sm:flex-row">
            @if ($isMember)
                <x-secondary-button class="w-full justify-center sm:w-auto" wire:click="leaveCommunity">
                    Sair
                </x-secondary-button>
            @else
                <x-secondary-button class="w-full justify-center sm:w-auto" wire:click="joinCommunity">
                    Entrar
                </x-secondary-button>
            @endif

            @auth
                @if ($isMember)
                    <x-primary-button wire:click="mountAction('createPost')" class="w-full justify-center sm:w-auto">
                        Criar post
                    </x-primary-button>
                @endif
            @endauth
        </div>
    </div>

    <x-card class="space-y-6">
        <x-title>Veja todos os posts da comunidade</x-title>

        @forelse ($posts as $post)
            <livewire:post-card :post="$post" wire:key="post-{{ $post->id }}" />
        @empty
            <x-card :elevation="2" class="border-dashed text-center">
                <p class="text-text-medium">Ainda não há posts nesta comunidade. Seja o primeiro!</p>
            </x-card>
        @endforelse

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </x-card>

    <x-filament-actions::modals />
</div>

<?php
