<?php

declare(strict_types=1);

?>

<div class="space-y-4">
    <h3 class="font-family-secondary text-text-medium text-xs">Minhas comunidades</h3>

    <div class="space-y-4">
        @foreach ($userCommunities as $community)
            <a
                href="{{ route('communities.show', $community->slug) }}"
                @class([
                    'flex items-center justify-between rounded-lg p-4',
                    "bg-gradient-to-r from-indigo-600/10
                                      to-elevation-02dp outline outline-indigo-600/50" => $activeCommunityId === $community->id,
                    'hover:outline-text-low outline outline-transparent' => $activeCommunityId !== $community->id,
                ])
            >
                <div class="flex items-center gap-4">
                    <x-avatar collection="avatars" :model="$community" alt="{{$community->name}}" size="2xs" />

                    <p class="text-text-medium text-xs">
                        {{ $community->name }}
                    </p>
                </div>

                <span class="font-family-secondary rounded-full border border-indigo-600/50 bg-indigo-600/20 px-5 py-1">
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
