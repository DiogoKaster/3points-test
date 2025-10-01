<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

final class HomePage extends Component
{
    use WithPagination;

    public function render(): View
    {
        $stats = Cache::remember('home-stats', now()->addMinutes(10), static fn(): array => [
            'posts_count' => Post::query()->count(),
            'users_count' => User::query()->count(),
            'comments_count' => Comment::query()->count(),
        ]);

        $posts = collect();
        if (Auth::check()) {
            $followedCommunityIds = Auth::user()->communitiesJoined()->pluck('communities.id');

            $posts = Post::query()->whereIn('community_id', $followedCommunityIds)
                ->with(['author', 'community'])
                ->withCount('comments')
                ->latest()
                ->paginate();
        }

        return view('livewire.home-page', [
            'stats' => $stats,
            'posts' => $posts,
        ]);
    }
}
