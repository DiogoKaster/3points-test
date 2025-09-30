<?php

declare(strict_types=1);

?>

<aside class="border-r-outline-dark w-sm space-y-12 border-r p-8">
    <div class="flex items-center justify-between space-x-0.5">
        <div class="flex items-center space-x-2">
            <x-heroicon-o-academic-cap class="text-icon-high h-6 w-6" />
            <div>
                <p class="mb-1 font-bold">3Pontos</p>
                <p class="text-text-medium">Community</p>
            </div>
        </div>
        <x-heroicon-o-x-mark class="text-icon-high h-6 w-6" />
    </div>

    <div class="space-y-8">
        <div class="space-y-4">
            <x-sidebar-link href="/" icon="home">Home</x-sidebar-link>
            <x-sidebar-link href="/" icon="home">Explorar comunidades</x-sidebar-link>
            @auth
                <x-sidebar-link href="/" icon="home">Perfil</x-sidebar-link>
            @endauth
        </div>

        @auth
            <livewire:user-communities-sidebar />
        @endauth
    </div>
</aside>

<?php
