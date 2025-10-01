<?php

declare(strict_types=1);

namespace App\Livewire;

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

        $this->validate();

        $this->commentable->comments()->create([
            'user_id' => Auth::id(),
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
