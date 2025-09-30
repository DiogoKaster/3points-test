<?php

declare(strict_types=1);

?>
@props(['disabled' => false])

<input
    @disabled($disabled)
    {{
        $attributes->merge([
            'class' => 'p-3 bg-elevation-05dp dark:text-gray-300 rounded-md shadow-sm',
        ])
    }}
/>
<?php 
