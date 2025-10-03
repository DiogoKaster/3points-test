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

    public ?int $activeCommunityId = null;

    protected $listeners = [
        'refresh-sidebar-communities' => '$refresh',
    ];

    public function mount(): void
    {
        $this->userCommunities = collect();

        if ($community = request()->route('community')) {
            $this->activeCommunityId = $community->id;
        }
    }

    public function render(): Factory|View|\Illuminate\View\View
    {
        if (Auth::check()) {
            $this->userCommunities = Auth::user()
                ->communitiesJoined()
                ->withCount('posts')
                ->get();
        }

        return view('livewire.user-communities-sidebar', [
            'activeCommunityId' => $this->activeCommunityId,
        ]);
    }
}
