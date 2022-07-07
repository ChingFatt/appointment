<?php

namespace App\Policies;

use App\Models\EmailConfig;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailConfigPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmailConfig  $emailConfig
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, EmailConfig $emailConfig)
    {
        return $user->merchant_id === $emailConfig->merchant_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmailConfig  $emailConfig
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, EmailConfig $emailConfig)
    {
        return $user->merchant_id === $emailConfig->merchant_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmailConfig  $emailConfig
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, EmailConfig $emailConfig)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmailConfig  $emailConfig
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, EmailConfig $emailConfig)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EmailConfig  $emailConfig
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, EmailConfig $emailConfig)
    {
        //
    }
}
