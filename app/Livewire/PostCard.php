<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Traits\HasComments;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

final class PostCard extends Component
{
    use HasComments;

    public Post $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
    ];

    public function getModel(): Model
    {
        return $this->post;
    }

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function delete(): void
    {
        if (Auth::guest()) {
            $this->redirect(route('login'));

            return;
        }

        $this->post->delete();
        $this->dispatch('postDeleted');
        $this->dispatch('refresh-sidebar-communities');
    }

    public function showPost(): RedirectResponse|Redirector
    {
        return redirect()->route('posts.show', [
            'community' => $this->post->community,
            'post' => $this->post,
        ]);
    }

    #[Computed]
    public function replies(): Collection
    {
        return $this->post
            ->comments()
            ->with('author', 'community')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.post-card', [
            'userVote' => $this->getUserVote(),
        ]);
    }
}
