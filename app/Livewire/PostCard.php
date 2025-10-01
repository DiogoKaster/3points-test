<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

final class PostCard extends Component
{
    public Post $post;

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function like(): void
    {
        // dd('aaaaa');
    }

    public function dislike(): void
    {
        // dd('bbbbb');
    }

    public function showPost(): RedirectResponse|Redirector
    {
        return redirect()->route('posts.show', [
            'community' => $this->post->community,
            'post' => $this->post,
        ]);
    }

    public function render(): View
    {
        return view('livewire.post-card');
    }
}
