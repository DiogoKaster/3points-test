<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\User;
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

    public function vote(User $user, int $type): void
    {
        $type = in_array($type, [1, -1], true) ? $type : 0;
        if ($type === 0) {
            return;
        }

        $existingVote = $this->votes()->where('user_id', $user->id)->first();

        if ($existingVote) {
            if ($existingVote->type === $type) {
                $this->votes += -$existingVote->type;
                $this->save();

                $existingVote->delete();
            } else {
                $delta = $type - $existingVote->type;
                $this->votes += $delta;
                $this->save();

                $existingVote->update(['type' => $type]);
            }
        } else {
            $this->votes += $type;
            $this->save();

            $this->votes()->create([
                'user_id' => $user->id,
                'type' => $type,
            ]);
        }
    }
}
