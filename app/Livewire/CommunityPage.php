<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Community;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithPagination;

final class CommunityPage extends Component
{
    use WithPagination;

    public Community $community;

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    public function joinCommunity(): RedirectResponse|Redirector|null
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $this->community->members()->attach(Auth::user());

        $this->dispatch('refresh-sidebar-communities');

        return null;
    }

    public function leaveCommunity(): RedirectResponse|Redirector|null
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $this->community->members()->detach(Auth::user());

        $this->dispatch('refresh-sidebar-communities');

        return null;
    }

    public function render(): View
    {
        $this->community->loadCount('members');

        $isMember = false;
        if (Auth::check()) {
            $isMember = $this->community->members()->where('user_id', Auth::id())->exists();
        }

        $posts = $this->community
            ->posts()
            ->with('author')
            ->latest()
            ->paginate(10);

        return view('livewire.community-page', [
            'posts' => $posts,
            'isMember' => $isMember,
        ]);
    }
}
