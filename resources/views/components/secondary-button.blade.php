<?php

declare(strict_types=1);

?>

<button
    {{
        $attributes->merge([
            'type' => 'button',
            'class' => 'inline-flex items-center
                    px-4 py-3 bg-transparent text-white border border-outline-dark hover:border-outline-medium
                    rounded-md font-semibold transition ease-in-out duration-150 cursor-pointer',
        ])
    }}
>
    {{ $slot }}
</button>

<?php
