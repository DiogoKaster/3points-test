<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

final class CommentCard extends Component
{
    public Comment $comment;

    public bool $showReplies = false;

    public bool $showReplyForm = false;

    public bool $isReply = false;

    protected $listeners = [
        'commentCreated' => '$refresh',
    ];

    public function mount(Comment $comment, bool $isReply = false): void
    {
        $this->comment = $comment;
        $this->isReply = $isReply;
    }

    public function upvote(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->comment->vote(Auth::user(), 1);
    }

    public function downvote(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->comment->vote(Auth::user(), -1);
    }

    #[Computed]
    public function replies(): Collection
    {
        return $this->comment
            ->replies()
            ->with('author', 'community')
            ->latest()
            ->get();
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

    public function render(): View|Factory
    {
        $userVote = null;
        $replies = $this->comment->replies()->count();

        if (Auth::check()) {
            $vote = $this->comment->votes()->where('user_id', Auth::id())->first();

            if ($vote) {
                $userVote = $vote->type;
            }
        }

        return view('livewire.comment-card', [
            'userVote' => $userVote,
            'replies' => $replies,
        ]);
    }
}
