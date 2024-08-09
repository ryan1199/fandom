<?php

namespace App\Policies;

use App\Models\Fandom;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FandomPolicy
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
    public function view(User $user, Fandom $fandom): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Fandom $fandom): bool
    {
        $fandom = Fandom::with(['members.role'])->find($fandom->id);
        $users = collect($fandom->members);
        $managers = $users->where('role.name', 'Manager');
        $managers_id = $managers->pluck('user.id')->toArray();
        return in_array($user->id, $managers_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Fandom $fandom): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Fandom $fandom): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Fandom $fandom): bool
    {
        //
    }
}
