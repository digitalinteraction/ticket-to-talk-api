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
    public function show(User $user, $id)
    {

        if($id == $user->id)
        {
            return true;
        }

        return false;
    }
}
