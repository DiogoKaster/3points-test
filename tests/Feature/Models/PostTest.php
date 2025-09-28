<?php

declare(strict_types=1);

use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use App\Models\User;

it('can create a post', function (): void {
    $user = User::factory()->create();
    $community = Community::factory()->create(['author_id' => $user->id]);

    $post = Post::factory()->create([
        'author_id' => $user->id,
        'community_id' => $community->id,
    ]);

    expect($post)->toBeInstanceOf(Post::class)
        ->and($post->author_id)->toBe($user->id)
        ->and($post->community_id)->toBe($community->id);
});

it('can update a post', function (): void {
    $post = Post::factory()->create();

    $post->update(['title' => 'Updated title']);

    expect($post->fresh()->title)->toBe('Updated title');
});

it('can delete a post', function (): void {
    $post = Post::factory()->create();

    $post->delete();

    expect(Post::query()->find($post->id))->toBeNull();
});

it('belongs to an author', function (): void {
    $user = User::factory()->create();
    $post = Post::factory()->create(['author_id' => $user->id]);

    expect($post->author)->toBeInstanceOf(User::class)
        ->and($post->author->id)->toBe($user->id);
});

it('belongs to a community', function (): void {
    $community = Community::factory()->create();
    $post = Post::factory()->create(['community_id' => $community->id]);

    expect($post->community)->toBeInstanceOf(Community::class)
        ->and($post->community->id)->toBe($community->id);
});

it('has many comments', function (): void {
    $post = Post::factory()->create();
    Comment::factory()->count(3)->create(['post_id' => $post->id]);

    expect($post->comments)->toHaveCount(3)
        ->and($post->comments->first())->toBeInstanceOf(Comment::class);
});

it('has votes', function (): void {
    $post = Post::factory()->create();
    $user = User::factory()->create();

    $post->votes()->create([
        'user_id' => $user->id,
        'type' => 1,
    ]);

    expect($post->votes()->count())->toBe(1)
        ->and($post->votes()->first()->type)->toBe(1);
});
