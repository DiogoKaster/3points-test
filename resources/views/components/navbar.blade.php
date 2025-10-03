<?php

declare(strict_types=1);

?>

<header
    class="bg-elevation-01dp border-b-helper-outline sticky top-0 flex h-16 items-center justify-center border-b px-8 py-4 md:justify-end"
>
    <div class="gap flex h-8 items-center space-x-8">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-secondary-button type="submit">Logout</x-secondary-button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Registrar</a>
        @endguest
    </div>
</header>

<?php
