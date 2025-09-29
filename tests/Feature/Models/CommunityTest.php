<?php

declare(strict_types=1);

use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function (): void {
    $this->user = User::factory()->create();
});

it('belongs to an author', function (): void {
    $community = Community::factory()->create([
        'author_id' => $this->user->id,
    ]);

    expect($community->author->is($this->user))->toBeTrue();
});

it('can have members', function (): void {
    $members = User::factory(3)->create();

    $community = Community::factory()->create([
        'author_id' => $this->user->id,
    ]);

    $community->members()->attach($members->pluck('id'));

    expect($community->members)->toHaveCount(3);
});

it('can have posts', function (): void {
    $community = Community::factory()->create([
        'author_id' => $this->user->id,
    ]);

    $post = Post::factory()->create([
        'community_id' => $community->id,
        'author_id' => $this->user->id,
    ]);

    expect($community->posts)->toHaveCount(1)
        ->and($community->posts->first()?->is($post))->toBeTrue();
});

it('can upload a cover image', function (): void {
    Storage::fake('communities');

    $community = Community::factory()->create([
        'author_id' => $this->user->id,
    ]);

    $community->addMedia(UploadedFile::fake()->image('cover.jpg'))
        ->toMediaCollection('cover');

    expect($community->cover)->toContain('cover.jpg');
});
