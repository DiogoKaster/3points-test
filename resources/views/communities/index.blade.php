<?php

declare(strict_types=1);

?>

<x-layouts.guest>
    <div>
        <!-- Feed -->
        <x-feed>
            <x-card class="space-y-8">
                <x-title>Veja as últimas comunidades criadas!</x-title>

                @forelse ($communities as $community)
                    <a
                        href="{{ route('communities.show', $community->slug) }}"
                        class="block"
                        wire:key="community-{{ $community->id }}"
                    >
                        <x-card class="hover:outline-text-low transition hover:scale-[1.01]" :elevation="2">
                            <div class="flex items-center space-x-4">
                                <x-avatar
                                    collection="avatars"
                                    :model="$community"
                                    alt="{{$community->name}}"
                                    size="md"
                                />

                                <div>
                                    <x-title>
                                        {{ $community->name }}
                                    </x-title>
                                    <p class="text-text-medium text-xs">c/{{ $community->slug }}</p>
                                </div>
                            </div>
                        </x-card>
                    </a>
                @empty
                    <x-card :elevation="2" class="border-dashed text-center">
                        <p class="text-text-medium">Ainda não existem comunidades!</p>
                    </x-card>
                @endforelse
            </x-card>
        </x-feed>
    </div>
</x-layouts.guest>

<?php
