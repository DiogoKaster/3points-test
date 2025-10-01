<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class UserCommunitiesSidebar extends Component
{
    public Collection $userCommunities;

    protected $listeners = [
        'refresh-sidebar-communities' => '$refresh',
    ];

    public function mount(): void
    {
        $this->userCommunities = collect();
    }

    public function render(): Factory|View|\Illuminate\View\View
    {
        if (Auth::check()) {
            $this->userCommunities = Auth::user()
                ->communitiesJoined()
                ->withCount('posts')
                ->get();
        }

        return view('livewire.user-communities-sidebar');
    }
}
