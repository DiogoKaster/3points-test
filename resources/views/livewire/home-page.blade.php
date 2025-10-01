<?php

declare(strict_types=1);

?>
<div class="space-y-8">
    <div class="space-y-6">
        <x-title>Dados da plataforma</x-title>
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-3">
            <x-stat-card icon="s-document-text" label="Posts Criados" :value="$stats['posts_count']" />

            <x-stat-card icon="s-users" label="Membros" :value="$stats['users_count']" />

            <x-stat-card
                icon="s-chat-bubble-left-right"
                label="Comentários e Respostas"
                :value="$stats['comments_count']"
            />
        </div>
    </div>

    <div class="space-y-6">
        <x-title class="font-bold">Veja os últimos posts das comunidades que você segue</x-title>

        @auth
            @forelse ($posts as $post)
                <livewire:post-card :post="$post" wire:key="post-{{ $post->id }}" />
            @empty
                <x-card :elevation="2" class="border-dashed text-center">
                    <p class="text-text-medium">
                        Você ainda não segue nenhuma comunidade ou não há posts novos.
                        <a href="{{ route('communities.index') }}" class="text-accent-medium hover:underline">
                            Explore comunidades
                        </a>
                    </p>
                </x-card>
            @endforelse

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @else
            <x-card :elevation="2" class="border-dashed text-center">
                <p class="text-text-medium">
                    <a href="{{ route('login') }}" class="text-accent-medium hover:underline">Entre</a>
                    ou
                    <a href="{{ route('register') }}" class="text-accent-medium hover:underline">crie uma conta</a>
                    para ver seu feed personalizado.
                </p>
            </x-card>
        @endauth
    </div>
</div>
<?php 
