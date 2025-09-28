<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasVotes
{
    /**
     * @return MorphMany<Vote, $this>
     */
    public function votes(): MorphMany
    {
        return $this->morphMany(Vote::class, 'votable');
    }
}
