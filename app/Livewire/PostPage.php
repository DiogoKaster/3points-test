<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class PostPage extends Component
{
    public Post $post;

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function upvote(Comment $comment): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $comment->vote(Auth::user(), 1);
    }

    public function downvote(Comment $comment): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $comment->vote(Auth::user(), -1);
    }

    public function render(): Factory|View|\Illuminate\View\View
    {
        return view('livewire.post-page');
    }
}
