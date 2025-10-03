<?php

declare(strict_types=1);
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Vote;

it('belongs to an author', function (): void {
    $user = User::factory()->create();
    $comment = Comment::factory()->for($user, 'author')->create();

    expect($comment->author->is($user))->toBeTrue();
});

it('belongs to a post', function (): void {
    $post = Post::factory()->create();
    $comment = Comment::factory()->for($post)->create();

    expect($comment->post->is($post))->toBeTrue();
});

it('can have replies', function (): void {
    $parent = Comment::factory()->create();
    $replyA = Comment::factory()->for($parent, 'parent')->create();
    $replyB = Comment::factory()->for($parent, 'parent')->create();

    expect($parent->replies)->toHaveCount(2)
        ->and($parent->replies->first())->toBeInstanceOf(Comment::class)
        ->and($replyA->parent->is($parent))->toBeTrue()
        ->and($replyB->parent->is($parent))->toBeTrue();
});

it('has votes', function (): void {
    $comment = Comment::factory()->create();

    Vote::factory()->create([
        'votable_id' => $comment->id,
        'votable_type' => Comment::class,
    ]);

    $votes = $comment->votes()->get();

    expect($votes)->toHaveCount(1)
        ->and($votes->first()->type)->toBe(1);
});
