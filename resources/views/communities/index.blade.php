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
                    <x-community-card :community="$community" />
                @endforeach
            </x-card>
        </x-feed>
    </div>
</x-layouts.guest>

<?php
