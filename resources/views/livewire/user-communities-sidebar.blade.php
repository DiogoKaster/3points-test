<?php

declare(strict_types=1);

?>
<div class="space-y-4">
    <h3 class="font-family-secondary text-text-medium text-xs">Minhas comunidades</h3>

    <div class="space-y-4">
        @foreach ($userCommunities as $community)
            <x-sidebar-link href="/{{ $community->slug }}" icon="home">{{ $community->name }}</x-sidebar-link>
        @endforeach
    </div>
</div>
<?php 
