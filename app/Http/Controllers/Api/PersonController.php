<?php

namespace App\Http\Controllers\Api;

use App\Area;
use App\Person;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

class PersonController extends Controller
{

    private $user;
    private $jwtauth;

    public function  __construct(User $user, JWTAuth $jwtauth)
    {
        $this->user = $user;
        $this->jwtauth = $jwtauth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $person = new Person();
        $person->name = $request->name;
        $person->birthYear = $request->birthYear;
        $person->birthPlace = $request->birthPlace;
        $person->relation = $request->relation;

        $saved = $person->save();
        $person->users()->attach($user->id, ['user_type' => 'admin']);

        // TODO: check area already exists
        $area = new Area();
        $area->townCity = $request->townCity;
        $area->county = $request->county;
        $area->country = $request->country;
        $area->save();

        $person->address()->associate($area->id);
        $person->save();


        if ($saved) {
            return response()->json(
                [
                    "status" => 200,
                    "message" => "Person saved",
                    "person" => $person,
                    'owner' => $user
                ]
            );
        } else
        {
            return response()->json(
                [
                    "status" => 500,
                    "message" => "Error saving person",
                    "person" => $person
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $personID = (int) Input::get('person_id');
        foreach($user->people as $people)
        {
            if ($personID ==  $people->id)
            {
                return response()->json(
                    [
                        "status" => 200,
                        "message" => "Person Found",
                        "people" => $people,
                    ]
                );
            }
        }
        return response()->json(
            [
                "status" => 500,
                "message" => "Person not found",
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUsers()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $personID = (int) Input::get('person_id');
        $person = $user->people->find($personID);

        if($person)
        {
            $users = $person->users;
            return response()->json(
                [
                    "status" => 200,
                    "users" => $users
                ]
            );
        }
    }

    public function getTickets()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $person_id = (int) Input::get('person_id');
        $person = $user->people->find($person_id);

        if($person)
        {
            $tickets = [];
            $areas = [];
            $tags = [];
            foreach($person->tickets as $ticket)
            {
                array_push($tickets, $ticket);
                array_push($areas, $ticket->area);
                foreach($ticket->tags as $tag)
                {
                    $already_added = false;
                    foreach($tags as $t)
                    {
                        if ($t == $tag)
                        {
                            $already_added = true;
                        }
                    }
                    if (!$already_added) 
                    {
                        array_push($tags, $tag);
                    }
                }
            }

            return response()->json(
                [
                    "status" => 200,
                    "tickets" => $tickets,
                    "areas" => $areas,
                    "tags" => $tags
                ]
            );
        } else
        {
            return response()->json(500);
        }
    }
}
