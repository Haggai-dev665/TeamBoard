<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;

class EmployeePolicy
{
    /**
     * Determine if the given employee can be viewed by the user.
     */
    public function view(?User $user, Employee $employee): bool
    {
        return true; // All users can view employees
    }

    /**
     * Determine if the user can create employees.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the given employee can be updated by the user.
     */
    public function update(User $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the given employee can be deleted by the user.
     */
    public function delete(User $user, Employee $employee): bool
    {
        return $user->isAdmin();
    }
}
