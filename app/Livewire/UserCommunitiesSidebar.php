<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

final class UserCommunitiesSidebar extends Component
{
    public Collection $userCommunities;

    public function mount(): void
    {
        $this->userCommunities = Auth::check()
            ? Auth::user()->communitiesJoined
            : collect();
    }

    public function render(): Factory|View|\Illuminate\View\View
    {
        return view('livewire.user-communities-sidebar');
    }
}
