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
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Reddit-like Home • Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />

        <!-- Styles / Scripts -->
        @filamentStyles
        @vite(['resources/css/app.css'])
    </head>
    <div
        class="pointer-events-none absolute inset-0 z-50 bg-gradient-to-b from-indigo-600/15 to-transparent mix-blend-multiply"
    ></div>
    {{ $slot }}
</html>

<?php
