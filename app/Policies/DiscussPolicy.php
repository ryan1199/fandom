<?php

namespace App\Policies;

use App\Models\Discuss;
use App\Models\Fandom;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DiscussPolicy
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
    public function view(User $user, Discuss $discuss): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Fandom $fandom): bool
    {
        $fandom = Fandom::with(['members.role', 'members.user'])->find($fandom->id);
        $users = collect($fandom->members);
        $managers = $users->where('role.name', 'Manager');
        $managers_id = $managers->pluck('user.id')->toArray();
        return in_array($user->id, $managers_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Discuss $discuss): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Discuss $discuss, Fandom $fandom): bool
    {
        $fandom = Fandom::with(['members.role', 'members.user'])->find($fandom->id);
        $users = collect($fandom->members);
        $managers = $users->where('role.name', 'Manager');
        $managers_id = $managers->pluck('user.id')->toArray();
        return in_array($user->id, $managers_id) && $discuss->fandom_id == $fandom->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Discuss $discuss): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Discuss $discuss): bool
    {
        //
    }

    public function reset(User $user, Discuss $discuss, Fandom $fandom): bool
    {
        $fandom = Fandom::with(['members.role', 'members.user'])->find($fandom->id);
        $users = collect($fandom->members);
        $managers = $users->where('role.name', 'Manager');
        $managers_id = $managers->pluck('user.id')->toArray();
        return in_array($user->id, $managers_id) && $discuss->fandom_id == $fandom->id;
    }

    public function submit(User $user, Discuss $discuss, Fandom $fandom): bool
    {
        switch($discuss->visible) {
            case 'manager':
                $fandom = Fandom::with(['members.role', 'members.user'])->find($fandom->id);
                $users = collect($fandom->members);
                $managers = $users->where('role.name', 'Manager');
                $managers_id = $managers->pluck('user.id')->toArray();
                return in_array($user->id, $managers_id) && $discuss->fandom_id == $fandom->id;
                break;
            case 'member':
                $fandom = Fandom::with(['members.role', 'members.user'])->find($fandom->id);
                $users = collect($fandom->members);
                $managers = $users->where('role.name', 'Manager');
                $managers_id = $managers->pluck('user.id')->toArray();
                $members = $users->where('role.name', 'Member');
                $members_id = $members->pluck('user.id')->toArray();
                return in_array($user->id, $managers_id) && $discuss->fandom_id == $fandom->id || in_array($user->id, $members_id) && $discuss->fandom_id == $fandom->id;
                break;
            default:
                return true;
        }
    }
}
