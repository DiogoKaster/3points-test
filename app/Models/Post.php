<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasVotes;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

final class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    use HasVotes;

    protected $fillable = [
        'title',
        'body',
        'votes',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return BelongsTo<Community, $this>
     */
    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    /**
     * @return HasMany<Comment, $this>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    protected static function booted(): void
    {
        self::creating(static function (Post $post): void {
            if (blank($post->author_id) && Auth::check()) {
                $post->author_id = Auth::id();
            }
        });
    }

    protected function casts(): array
    {
        return [
            'votes' => 'integer',
        ];
    }
}
