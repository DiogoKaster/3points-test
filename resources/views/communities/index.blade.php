<?php

declare(strict_types=1);

?>

<x-layouts.guest>
    <div>
        <!-- Feed -->
        <x-feed>
            <x-card class="space-y-8">
                <x-title>Veja as comunidades mais populares no momento!</x-title>

                @foreach ($communities as $community)
                    @php
                        $avatarUrl = $community->getFirstMediaUrl('avatars');
                    @endphp

                    <a
                        href="{{ route('communities.show', $community->slug) }}"
                        class="block"
                        wire:key="community-{{ $community->id }}"
                    >
                        <x-card :elevation="2">
                            <div class="flex items-center space-x-4">
                                @if ($avatarUrl)
                                    <img
                                        src="{{ $avatarUrl }}"
                                        alt="avatar {{ $community->name }}"
                                        class="h-12 w-12 rounded-full object-cover"
                                    />
                                @else
                                    <x-heroicon-o-user-circle class="text-text-medium h-12 w-12" />
                                @endif

                                <div>
                                    <x-title>
                                        {{ $community->name }}
                                    </x-title>
                                    <p class="text-text-medium text-xs">c/{{ $community->slug }}</p>
                                </div>
                            </div>
                        </x-card>
                    </a>
                @endforeach
            </x-card>
        </x-feed>
    </div>
</x-layouts.guest>

<?php
