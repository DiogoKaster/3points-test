<?php

declare(strict_types=1);

?>

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="dark bg-elevation-surface leading-default text-text-high h-full"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Reddit-like Home • Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex min-h-full">
        <!-- Sidebar -->
        <x-sidebar />

        <div class="flex flex-1 flex-col">
            <!-- Top Nav -->
            <x-navbar />

            <main class="p-8">
                <!-- Content -->
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

<?php
