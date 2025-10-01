<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Post;
use Illuminate\Contracts\View\View;

final class PostController extends Controller
{
    public function show(Community $community, Post $post): View
    {
        return view('posts.show', [
            'community' => $community,
            'post' => $post,
        ]);
    }
}
