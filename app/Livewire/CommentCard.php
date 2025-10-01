<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class CommentCard extends Component
{
    public Comment $comment;

    public function mount(Comment $comment): void
    {
        $this->comment = $comment;
    }

    public function upvote(Comment $comment): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->comment->vote(Auth::user(), 1);
    }

    public function downvote(Comment $comment): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->comment->vote(Auth::user(), -1);
    }

    public function render(): View|Factory
    {
        $userVote = null;

        if (Auth::check()) {
            $vote = $this->comment->votes()->where('user_id', Auth::id())->first();

            if ($vote) {
                $userVote = $vote->type;
            }
        }

        return view('livewire.comment-card', [
            'userVote' => $userVote,
        ]);
    }
}
