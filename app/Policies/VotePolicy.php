<?php

namespace App\Policies;

use App\Models\Request;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Auth\Access\Response;

class VotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vote $vote): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Request $request): bool
    {
        $fandom = $request->fandom;
        $members = $fandom->members->pluck('user.id')->toArray();
        $vote = $request->votes()->where('user_id', $user->id)->first();
        return in_array($user->id, $members) && $vote == null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vote $vote): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vote $vote): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vote $vote): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vote $vote): bool
    {
        //
    }
}
