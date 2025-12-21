<?php

namespace App\Policies;

use App\Models\Notice;
use App\Models\User;

class NoticePolicy
{
    /**
     * Determine if the given notice can be viewed by the user.
     */
    public function view(?User $user, Notice $notice): bool
    {
        return true; // All users can view notices
    }

    /**
     * Determine if the user can create notices.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create notices
    }

    /**
     * Determine if the given notice can be updated by the user.
     */
    public function update(User $user, Notice $notice): bool
    {
        return $user->id === $notice->author_id || $user->isAdmin();
    }

    /**
     * Determine if the given notice can be deleted by the user.
     */
    public function delete(User $user, Notice $notice): bool
    {
        return $user->id === $notice->author_id || $user->isAdmin();
    }
}
