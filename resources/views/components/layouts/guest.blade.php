<?php

declare(strict_types=1);

?>

<x-layouts.partials.head>
    <body class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar />

        <div class="flex flex-1 flex-col">
            <!-- Top Nav -->
            <x-navbar />

            <main class="overflow-y-auto p-4 md:p-8">
                <!-- Content -->
                {{ $slot }}
            </main>
        </div>
    </body>
</x-layouts.partials.head>

<?php
