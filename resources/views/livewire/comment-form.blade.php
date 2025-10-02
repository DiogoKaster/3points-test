<?php

declare(strict_types=1);

?>

{{-- resources/views/livewire/comment-form.blade.php --}}
<x-card>
    <form wire:submit="createComment" class="space-y-4">
        <textarea
            wire:model="body"
            placeholder="Adicionar um comentário..."
            rows="2"
            class="border-outline-dark bg-elevation-01dp text-text-high w-full rounded-md p-2 text-xs"
        ></textarea>

        <hr class="border-outline-dark" />

        <div class="flex justify-end">
            <x-primary-button class="text-2xs" type="submit">Responder</x-primary-button>
        </div>
    </form>
</x-card>

<?php
