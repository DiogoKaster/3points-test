<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Community;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

final class CommunityPage extends Component
{
    use WithPagination;

    public Community $community;

    public function mount(Community $community): void
    {
        $this->community = $community;

        $this->community->loadCount('members');
    }

    public function render(): View
    {
        $posts = $this->community
            ->posts()
            ->with('author')
            ->latest()
            ->paginate(10);

        return view('livewire.community-page', [
            'posts' => $posts,
        ]);
    }
}
