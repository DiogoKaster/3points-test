<?php

declare(strict_types=1);

?>

@props([
    'elevation' => 1,
])

<div
    {{
        $attributes->class([
            match ($elevation) {
                2 => 'bg-elevation-02dp',
                3 => 'bg-elevation-03dp',
                default => 'bg-elevation-01dp',
            },

            'p-4',
            'md:p-6',
            'rounded-xl',
            'border',
            'border-helper-outline',
        ])
    }}
>
    {{ $slot }}
</div>

<?php
