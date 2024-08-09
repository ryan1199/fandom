<?php

namespace App\Policies;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GalleryPolicy
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
    public function view(User $user, Gallery $gallery): bool
    {
        $gallery = Gallery::with(['user','publish.publishable'])->find($gallery->id);
        if(class_basename($gallery->publish->publishable_type) === 'User') {
            if($gallery->publish->publishable_id == $user->id) {
                return true;
            } else {
                switch($gallery->publish->visible) {
                    case 'public':
                        return true;
                        break;
                    case 'self':
                        return false;
                        break;
                }
            }
        }
        if(class_basename($gallery->publish->publishable_type) === 'Fandom') {
            if(in_array($user->id, $gallery->publish->publishable->members->pluck('user.id')->toArray())) {
                return true;
            } else {
                switch($gallery->publish->visible) {
                    case 'public':
                        return true;
                        break;
                    case 'member':
                        return false;
                        break;
                }
            }
        }
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
    public function update(User $user, Gallery $gallery): bool
    {
        return $user->id === $gallery->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gallery $gallery): bool
    {
        return $user->id === $gallery->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gallery $gallery): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gallery $gallery): bool
    {
        //
    }
}
