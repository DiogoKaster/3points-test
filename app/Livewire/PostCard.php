<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

final class PostCard extends Component
{
    public Post $post;

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function upvote(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->post->vote(Auth::user(), 1);
    }

    public function downvote(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->post->vote(Auth::user(), -1);
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
        $userVote = null;

        if (Auth::check()) {
            $vote = $this->post->votes()->where('user_id', Auth::id())->first();

            if ($vote) {
                $userVote = $vote->type;
            }
        }

        return view('livewire.post-card',
            [
                'userVote' => $userVote,
            ]);
    }
}
