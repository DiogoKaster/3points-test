<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class CommentForm extends Component
{
    public Model $commentable;

    public string $body = '';

    public function mount(Model $commentable): void
    {
        $this->commentable = $commentable;
    }

    public function createComment(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->validate([
            'body' => 'required|min:3|max:255',
        ]);

        $postId = null;
        if ($this->commentable instanceof Post) {
            $postId = $this->commentable->id;
        } elseif ($this->commentable instanceof Comment) {
            $postId = $this->commentable->post_id;
        }

        $this->commentable->comments()->create([
            'author_id' => Auth::id(),
            'post_id' => $postId,
            'body' => $this->body,
        ]);

        $this->reset('body');
        $this->dispatch('commentCreated');
    }

    public function render(): View
    {
        return view('livewire.comment-form');
    }
}
