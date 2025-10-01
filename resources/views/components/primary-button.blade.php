<?php

declare(strict_types=1);

?>

<button
    {{
        $attributes->merge([
            'type' => 'submit',
            'class' => 'inline-flex items-center
                    px-4 py-3 bg-indigo-600 text-white border border-transparent rounded-md font-semibold
                    hover:bg-indigo-500 transition ease-in-out duration-150 cursor-pointer',
        ])
    }}
>
    {{ $slot }}
</button>

<?php
