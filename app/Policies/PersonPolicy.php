<?php

namespace App\Policies;

use App\Invite;
use App\Person;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
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
     * Check a user is linked to a person.
     *
     * @param User $user
     * @param Person $person
     * @return bool
     */
    public function view(User $user, Person $person)
    {
        $stored_person = $user->people->find($person->id);
        if($stored_person)
        {
           return true;
        }
        else
        {
            $invite = Invite::where('recipient_email', $user->email)->where('person_id', $person->id)->get()->first();
            if ($invite)
            {
                return true;
            }
            return false;
        }
    }

    /**
     * Check if user is admin
     *
     * @param User $user
     * @param Person $person
     * @return bool
     */
    public function delete(User $user, Person $person)
    {
        if($person->admin_id == $user->id)
        {
            return true;
        }

        return false;
    }

    /**
     * Check if user can download a person's profile picture.
     *
     * @param User $user
     * @param $filename
     * @return bool
     */
    public function download_person_profile_picture(User $user, $filename)
    {
        $string = explode('_', $filename);

        $person = $user->people->find(intval(explode('.', $string[1])));
        if ($person)
        {
            return true;
        }

        return false;
    }

}
