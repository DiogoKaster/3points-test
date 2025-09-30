<?php

declare(strict_types=1);

?>

<div class="space-y-4">
    <h3 class="font-family-secondary text-text-medium text-xs">Minhas comunidades</h3>

    <div class="space-y-4">
        @foreach ($userCommunities as $community)
            <a
                href="/"
                class="hover:bg-elevation-02dp hover:outline-helper-outline flex items-center justify-between rounded-lg p-4 hover:outline"
            >
                @php
                    $avatarUrl = $community->getFirstMediaUrl('avatars');
                @endphp

                <div class="flex items-center gap-4">
                    @if ($avatarUrl)
                        <img
                            src="{{ $avatarUrl }}"
                            alt="avatar {{ $community->name }}"
                            class="h-5 w-5 rounded-full object-cover"
                        />
                    @else
                        <x-heroicon-o-user-circle class="text-text-medium h-5 w-5" />
                    @endif

                    <p class="text-text-medium text-xs">
                        {{ $community->name }}
                    </p>
                </div>

                <span class="font-family-secondary bg-helper-outline rounded-full px-3 py-1.5">
                    @if ($community->posts_count > 999)
                        +999
                    @else
                        {{ $community->posts_count }}
                    @endif
                </span>
            </a>
        @endforeach
    </div>
</div>

<?php
