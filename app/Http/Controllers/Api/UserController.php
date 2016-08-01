<?php

namespace App\Http\Controllers\Api;

use App\Invitation;
use App\Person;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

class UserController extends Controller
{

    private $user;
    private $jwtauth;

    public function  __construct(User $user, JWTAuth $jwtauth)
    {
        $this->user = $user;
        $this->jwtauth = $jwtauth;
    }

    public function testPost(Request $request)
    {
        dd($request);
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
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Get all user's associated with authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssociatedPeople ()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $people = [];
        $periods = [];

        foreach ($user->people as $person)
        {
            array_push($people, $person);

            foreach ($person->periods as $period)
            {
                array_push($periods, $period);
            }
        }

        return response()->json(
            [
                "people" => $people,
                "periods" => $periods
            ], 200
        );
    }

    /**
     * Send an invitation to join a person.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendInvitation(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $person = Person::find($request->person_id);
        $invitee = User::where("email", $request->email)->get()->first();
        
        if(!$invitee) 
        {
            return response()->json(
                [
                    "Status" => 500,
                    "Message" => "User not found.",
                ]
            );
        }

        $invitee->invitations()->attach($person->id, ["user_type" => $request->group, "inviter_id" => $user->id]);

        return response()->json(
            [
                "status" => 200,
                "added" => true
            ]
        );
    }
    /**
     * Get all of the user's invitations.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInvitations() 
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $invites = [];
        foreach ($user->invitations as $inv)
        {
            $invite = new Invitation();
            $person = Person::find($inv->pivot->person_id);
            $name = User::find($inv->pivot->user_id)->name;
            $group = $inv->pivot->user_type;

            $invite->person = $person;
            $invite->name = $name;
            $invite->group = $group;

            array_push($invites, $invite);
        }

        return response()->json(
            [
                "invites" => $invites
            ]
        );
    }


    /**
     * Accept an invitation.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function acceptInvitation(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated.",
                ]
            );
        }

        $person = Person::find($request->person_id);
        $user->invitations()->dettach($person->id);
        $user->people()->attach($person->id, $request->user_type);

        return response()->json(
            [
                "Status" => 200,
                "person" => $user->people()->find($person->id)
            ]
        );
    }
}
