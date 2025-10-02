<?php

declare(strict_types=1);

namespace App\Livewire\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait HasComments
{
    public bool $showReplies = false;

    public bool $showReplyForm = false;

    abstract public function getModel(): Model;

    public function upvote(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->getModel()->vote(Auth::user(), 1);
    }

    public function downvote(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->getModel()->vote(Auth::user(), -1);
    }

    public function toggleReplies(): void
    {
        $this->showReplies = ! $this->showReplies;
    }

    public function toggleReplyForm(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->showReplyForm = ! $this->showReplyForm;
    }

    protected function getUserVote(): ?int
    {
        if (Auth::check()) {
            return $this->getModel()->votes()->where('user_id', Auth::id())->first()?->type;
        }

        return null;
    }
}
