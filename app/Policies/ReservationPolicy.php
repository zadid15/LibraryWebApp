<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return in_array($user->role, ['admin', 'staff']) && $user->status === 'active'
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): Response
    {
        return in_array($user->role, ['admin', 'staff']) && $user->status === 'active'
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return in_array($user->role, ['admin', 'staff']) && $user->status === 'active'
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): Response
    {
        return in_array($user->role, ['admin', 'staff']) && $user->status === 'active'
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): Response
    {
        return in_array($user->role, ['admin', 'staff']) && $user->status === 'active'
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Reservation $reservation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Reservation $reservation): bool
    {
        return false;
    }
}
