<?php

namespace App\Policies;

use App\Models\Fandom;
use App\Models\Request;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RequestPolicy
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
    public function view(User $user, Request $request): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Fandom $fandom): bool
    {
        $fandom = Fandom::with(['members.role'])->find($fandom->id);
        $members = $fandom->members->pluck('user.id')->toArray();
        return in_array($user->id, $members);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Request $request): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Request $request, Fandom $fandom): bool
    {
        $fandom = Fandom::with(['members.role'])->find($fandom->id);
        $managers = $fandom->members->where('role.name', 'Manager')->pluck('user.id')->toArray();
        return in_array($user->id, $managers) || $request->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Request $request): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Request $request): bool
    {
        //
    }
}
