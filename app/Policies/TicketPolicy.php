<?php

namespace App\Policies;

use App\Ticket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * TicketPolicy constructor.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Ticket $ticket)
    {

        foreach ($user->people as $person)
        {
            $user_type = $user->people->find($person->id)->pivot->user_type;

            // If user is admin and ticket to belongs to one of their attached people.
            foreach ($person->tickets as $p_ticket)
            {

                // If ticket is one requested.
                if($p_ticket->id == $ticket->id)
                {

                    // If user has admin rights...
                    if($user_type == "All" || $user_type == "Admin")
                    {
                        return true;
                    }

                    switch ($ticket->access_level)
                    {
                        // If ticket is open to everyone.
                        case ('All'):
                            return true;
                            break;
                        case ('Family'):
                            if ($user_type == "Family")
                            {
                                return true;
                            }
                            break;
                        case ('Friends'):
                            if ($user_type == "Family" || $user_type == "Friends")
                            {
                                return true;
                            }
                            break;
                        case ('Other (Professionals)'):
                            if ($user_type == "Family" || $user_type == "Friends" || $user_type == "Other (Professionals)")
                            {
                                return true;
                            }
                            break;
                        default:
                            return false;
                            break;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Check if user is admin of person to delete the ticket.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return bool
     */
    public function destroy(User $user, Ticket $ticket)
    {
        $person_id = $ticket->person_id;

        foreach($user->people() as $person)
        {
            if ($person_id == $person->id)
            {
                if($user->id == $person->admin_id)
                {
                    return true;
                }
            }
        }

        return false;
    }
}
