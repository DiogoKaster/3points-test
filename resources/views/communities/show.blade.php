<?php

declare(strict_types=1);

?>

<x-layouts.guest>
    <div>
        <!-- Feed -->
        <x-feed>
            <livewire:community-page :community="$community" />
        </x-feed>
    </div>
</x-layouts.guest>

<?php
