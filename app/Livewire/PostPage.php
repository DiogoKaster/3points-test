<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class PostPage extends Component
{
    public Post $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
    ];

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function render(): Factory|View|\Illuminate\View\View
    {
        $comments = $this->post
            ->comments()
            ->with('replies')
            ->withCount('replies')
            ->whereNull('parent_id')
            ->latest()
            ->get();

        return view('livewire.post-page', [
            'comments' => $comments,
        ]);
    }
}
