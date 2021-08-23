<?php

namespace App\Policies;

use App\Models\OperatingHour;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OperatingHourPolicy
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
     * @param  \App\Models\OperatingHour  $operatingHour
     * @return mixed
     */
    public function view(User $user, OperatingHour $operatingHour)
    {
        return $user->merchant_id === $operatingHour->outlet->merchant->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OperatingHour  $operatingHour
     * @return mixed
     */
    public function update(User $user, OperatingHour $operatingHour)
    {
        return $user->merchant_id === $operatingHour->outlet->merchant->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OperatingHour  $operatingHour
     * @return mixed
     */
    public function delete(User $user, OperatingHour $operatingHour)
    {
        return $user->merchant_id === $operatingHour->outlet->merchant->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OperatingHour  $operatingHour
     * @return mixed
     */
    public function restore(User $user, OperatingHour $operatingHour)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OperatingHour  $operatingHour
     * @return mixed
     */
    public function forceDelete(User $user, OperatingHour $operatingHour)
    {
        return false;
    }
}
