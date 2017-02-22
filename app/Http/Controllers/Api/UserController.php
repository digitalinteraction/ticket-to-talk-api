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
use Illuminate\Support\Facades\Storage;
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
     * @api {post} /user/update Update a User
     * @apiName UpdateUser
     * @apiGroup User
     *
     * @apiParam {String} name The user's name.
     * @apiParam {String} email The user's email.
     * @apiParam {String} password Hashed version of the user's password.
     * @apiParam {String} imageHash SHA256 Hash of the user's profile photo.
     * @apiParam {byte[]} image Byte array of the user's profile picture.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} Status The response code
     * @apiSuccess {String} Message Update confirmation
     * @apiSuccess {User} User The updated user.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
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
                ],401
            );
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($request->imageHash != null)
        {
            $user->imageHash = $request->imageHash;

            $file_path = "ticket_to_talk/ storage/profile/u_" . $user->id . ".jpg";
            $data = base64_decode($request->image);

            Storage::disk('s3')->put($file_path, $data);
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
     * @api {get} /user/getpeople Get A User's People
     * @apiName GetUsersPeople
     * @apiGroup User
     *
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {Person[]} people The people linked to the user's account.
     * @apiSuccess {Period[]} periods The periods attached to these people.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
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
                ],401
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
     * @api {post} /user/invitations/send Invite a User to Join a Person
     * @apiName SendPersonInvitation
     * @apiGroup User
     *
     * @apiParam {String} person_id The person's ID.
     * @apiParam {String} email The recipient's email address.
     * @apiParam {String} group The user group the recipient is to join.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code.
     * @apiSuccess {boolean} added Whether the invitation was successful.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
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
                ],401
            );
        }

        $person = Person::find($request->person_id);

        $invite = new Invite();
        $invite->person_id = $person->id;
        $invite->sender_email = $user->email;
        $invite->recipient_email = $request->email;
        $invite->group = $request->group;

        $invite->save();

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
     * @api {get} /user/invitations/get Get a User's Invitations
     * @apiName GetPersonInvitation
     * @apiGroup User
     *
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {Invitation[]} invites The user's invitations.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
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
                ],401
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
     * @api {post} /user/invitations/accept Accept and Invitation
     * @apiName AcceptPersonInvitation
     * @apiGroup User
     *
     * @apiParam {String} person_id The person's ID.
     * @apiParam {String} relation The user's relation to the person.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} Status The response code.
     * @apiSuccess {Person} person The person the user accepted the invite for.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
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
                ],401
            );
        }

        $invite = Invite::where('recipient_email', $user->email)->where('person_id', $request->person_id)->get()->first();
        $user->people()->attach($request->person_id, ["user_type" => $invite->group, "relation" => $request->relation]);

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
     * @api {post} /user/invitations/reject Reject an Invitation
     * @apiName RejectPersonInvitation
     * @apiGroup User
     *
     * @apiParam {String} person_id The person's ID.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} Status The response code.
     * @apiSuccess {String} Messages Server message.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
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
                ],401
            );
        }

        $invite = Invite::where('recipient_email', $user->email)->where('person_id', $request->person_id)->get()->first();
        $invite->delete();

        return response()->json(
            [
                "Status" => 200,
                "Message" => "Invitation rejected"
            ]
        );
    }

    /**
     * Download a user profile picture.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getProfilePicture()
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        $id = Input::get('id');

        if($user->can('view', $id))
        {
            $fileName = 'u_'.$id.'.jpg';

            $file_type = 'image/jpeg';

            $exists = Storage::disk('s3')->exists($fileName);
            if ($exists)
            {
                // FROM: https://laracasts.com/discuss/channels/laravel/download-file-from-cloud-disk-s3-with-laravel-51
                $file_contents = Storage::disk('s3')->get($fileName);

                $response = response($file_contents, 200, [
                    'Content-Type' => $file_type,
                    'Content-Description' => 'File Transfer',
                    'Content-Disposition' => "attachment; filename={$fileName}",
                    'Content-Transfer-Encoding' => 'binary',
                ]);

                ob_end_clean(); // <- this is important, i have forgotten why.

                return $response;
            }
        }
        else
        {
            return response()->json(
                [
                    "Status" => 403,
                    "Message" => "Unauthorised for resource"
                ],403
            );
        }
    }
}
