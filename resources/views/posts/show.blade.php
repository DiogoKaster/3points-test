<?php

declare(strict_types=1);

?>

<x-layouts.guest>
    <div>
        <!-- Feed -->
        <x-feed>
            <livewire:post-page :post="$post" />
        </x-feed>
    </div>
</x-layouts.guest>

<?php
