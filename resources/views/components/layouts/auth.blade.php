<?php

declare(strict_types=1);

?>

<x-layouts.partials.head>
    <body class="antialiased">
        <div class="flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
            <div class="bg-elevation-02dp mt-6 w-full overflow-hidden px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        @livewire('notifications')
        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</x-layouts.partials.head>

<?php
