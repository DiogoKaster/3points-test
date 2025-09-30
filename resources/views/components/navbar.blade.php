<?php

declare(strict_types=1);

?>

<header
    class="bg-elevation-01dp border-b-helper-outline sticky top-0 flex h-16 items-center justify-end border-b px-8 py-4"
>
    <div class="gap flex h-8 items-center space-x-8">
        @auth
            <p>Icon</p>
            <p>Icon</p>
            <p>Profile</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="hover:text-red-500">Logout</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Registrar</a>
        @endguest
    </div>
</header>

<?php
