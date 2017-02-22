<?php

namespace App\Policies;

use App\Ticket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    /**
     * Creates a new policy instance
     *
     * MediaPolicy constructor.
     */
    public function __construct()
    {
        //
    }
}
