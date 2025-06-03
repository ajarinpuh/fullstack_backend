<?php

namespace App\Policies;

use App\Models\User;
use App\Models\post;
use Illuminate\Auth\Access\Response;

class PostPolicy
{   

    public function modify(User $user,Post $post): Response
    {
        return $user->id === $post->user_id
        ? Response::allow()
        : Response::deny("you do not own this post");
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, post $post): bool
    {
        return false;
    }
}
