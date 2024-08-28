<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
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
    public function view(?User $user, Post $post): bool
    {
        $post = Post::with(['user','publish.publishable'])->find($post->id);
        if($post->publish != null) {
            if(class_basename($post->publish->publishable_type) === 'User') {
                if($user != null) {
                    if($post->publish->publishable_id == $user->id) {
                        return true;
                    } else {
                        switch($post->publish->visible) {
                            case 'public':
                                return true;
                                break;
                            case 'friend':
                                $user->load('follows');
                                $followed_user = false;
                                foreach ($user->follows as $follow) {
                                    if($follow->id == $post->publish->publishable_id) {
                                        $followed_user = true;
                                        break;
                                    }
                                }
                                return $followed_user;
                                break;
                            case 'self':
                                return false;
                                break;
                        }
                    }
                } 
                if($user == null) {
                    switch($post->publish->visible) {
                        case 'public':
                            return true;
                            break;
                        case 'friend':
                            return false;
                            break;
                        case 'self':
                            return false;
                            break;
                    }
                }
            }
            if(class_basename($post->publish->publishable_type) === 'Fandom') {
                if($user != null) {
                    if(in_array($user->id, $post->publish->publishable->members->pluck('user.id')->toArray())) {
                        return true;
                    } else {
                        switch($post->publish->visible) {
                            case 'public':
                                return true;
                                break;
                            case 'member':
                                return false;
                                break;
                        }
                    }
                }
                if($user == null) {
                    switch($post->publish->visible) {
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
        if($post->publish == null) {
            if($user != null) {
                if($post->user_id == $user->id) {
                    return true;
                } else {
                    return false;
                }
            }
            if($user == null) {
                return false;
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
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }

    public function owner(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
