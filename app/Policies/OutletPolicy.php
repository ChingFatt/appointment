<?php

namespace App\Policies;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OutletPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Outlet  $outlet
     * @return mixed
     */
    public function view(User $user, Outlet $outlet)
    {
        return $user->merchant_id === $outlet->merchant_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->merchant_id === $outlet->merchant_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Outlet  $outlet
     * @return mixed
     */
    public function update(User $user, Outlet $outlet)
    {
        return $user->merchant_id === $outlet->merchant_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Outlet  $outlet
     * @return mixed
     */
    public function delete(User $user, Outlet $outlet)
    {
        return $user->merchant_id === $outlet->merchant_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Outlet  $outlet
     * @return mixed
     */
    public function restore(User $user, Outlet $outlet)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Outlet  $outlet
     * @return mixed
     */
    public function forceDelete(User $user, Outlet $outlet)
    {
        return false;
    }
}
