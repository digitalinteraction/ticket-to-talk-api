<?php

namespace App\Http\Controllers\Api;

use App\Invitation;
use App\Invite;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request)
    {
        //
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

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($request->imageHash != null)
        {
            $user->imageHash = $request->imageHash;

            $file_path = "storage/profile/u_" . $user->id . ".jpg";
            $data = base64_decode($request->image);
            $file = fopen($file_path, "wb");
            fwrite($file, $data);
            fclose($file);
        }

        $saved = $user->save();

        if ($saved)
        {
            return response()->json(
                [
                    "Status" => 200,
                    "Message" => "User updated.",
                    "User" => $user

                ]
            );
        }
        else
        {
            return response(
                [
                    "Status" => 500,
                ],500
            );
        }

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
//        $invitee = User::where("email", $request->email)->get()->first();
//
//        if(!$invitee)
//        {
//            return response()->json(
//                [
//                    "Status" => 500,
//                    "Message" => "User not found.",
//                ]
//            );
//        }
        $invite = new Invite();
        $invite->person_id = $person->id;
        $invite->sender_email = $user->email;
        $invite->recipient_email = $request->email;
        $invite->group = $request->group;

        $invite->save();

//        $invitee->invitations()->attach($person->id, ["user_type" => $request->group, "inviter_id" => $user->id]);

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

        $r_invites = Invite::where('recipient_email', $user->email)->get();

        foreach ($r_invites as $invite)
        {
            $person = Person::find($invite->person_id);
            $name = User::where('email', $invite->sender_email)->get()->first()->name;
            $group = $invite->group;

            $invite = new Invitation();
            $invite->person = $person;
            $invite->name = $name;
            $invite->group = $group;

            array_push($invites, $invite);
        }

//        foreach ($user->invitations as $inv)
//        {
//            $invite = new Invitation();
//            $person = Person::find($inv->pivot->person_id);
//            $name = User::find($inv->pivot->user_id)->name;
//            $group = $inv->pivot->user_type;
//
//            $invite->person = $person;
//            $invite->name = $name;
//            $invite->group = $group;
//
//            array_push($invites, $invite);
//        }

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

        $invite = Invite::where('recipient_email', $user->email)->where('person_id', $request->person_id)->get()->first();

//        $invite = $user->invitations()->find($request->person_id);
//        $user->people()->attach($request->person_id, ["user_type" => $invite->pivot->user_type, "relation" => $request->relation]);
        $user->people()->attach($request->person_id, ["user_type" => $invite->group, "relation" => $request->relation]);

//        $user->invitations()->detach($request->person_id);

        $invite->delete();

        return response()->json(
            [
                "Status" => 200,
                "person" => $user->people()->find($request->person_id)
            ]
        );
    }

    /**
     * Reject an invitation
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rejectInvitation(Request $request)
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

        $invite = Invite::where('recipient_email', $user->email)->where('person_id', $request->person_id)->get()->first();
        $invite->delete();
//        $user->invitations()->detach($request->person_id);

        return response()->json(
            [
                "Status" => 200,
                "Message" => "Invitation rejected"
            ]
        );
    }
}
