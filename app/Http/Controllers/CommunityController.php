<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\View\View;

final class CommunityController extends Controller
{
    public function index(): View
    {
        $communities = Community::query()
            ->latest()
            ->paginate();

        return view('communities.index', [
            'communities' => $communities,
        ]);
    }

    public function show(Community $community): View
    {
        return view('communities.show', [
            'community' => $community,
        ]);
    }
}
