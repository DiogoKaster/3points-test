<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Traits\HasComments;
use App\Models\Comment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

final class CommentCard extends Component
{
    use HasComments;

    public Comment $comment;

    public bool $isReply = false;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
    ];

    public function getModel(): Model
    {
        return $this->comment;
    }

    public function mount(Comment $comment, bool $isReply = false): void
    {
        $this->comment = $comment;
        $this->isReply = $isReply;
    }

    public function delete(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->comment->delete();
        $this->dispatch('commentDeleted');
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

    public function render(): View|Factory
    {
        return view('livewire.comment-card', [
            'userVote' => $this->getUserVote(),
            'replies' => $this->comment->replies()->count(),
        ]);
    }
}
