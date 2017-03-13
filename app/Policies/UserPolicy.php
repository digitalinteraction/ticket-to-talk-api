<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param $id
     * @return bool
     */
    public function update(User $user, $l_user)
    {

        if($l_user->id == $user->id)
        {
            return true;
        }

        return false;
    }
}
