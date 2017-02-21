<?php

namespace App\Http\Controllers\Api;

use App\Area;
use App\Period;
use App\Person;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Exceptions\JWTException;
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
     * @api {post} /people/store Save a person
     * @apiName StorePerson
     * @apiGroup People
     *
     * @apiParam {String} name Person's name.
     * @apiParam {String} birthYear Person's birth year.
     * @apiParam {String} birthPlace Person's birth place.
     * @apiParam {String} notes User's notes on the person.
     * @apiParam {String} townCity Where the person spent most of their life.
     * @apiParam {String} relation User's relation to the person.
     * @apiParam {byte[]} image Picture of the person.
     * @apiParam {String} imageHash SHA256 hash of the image byte array.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Person} person The newly created person.
     * @apiSuccess {User} owner The user who created the person.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
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
                    "Status" => 401,
                    "Message" => "User not authenticated.",
                ],401
            );
        }

        $person = new Person();
        $person->name = $request->name;
        $person->birthYear = $request->birthYear;
        $person->birthPlace = $request->birthPlace;
        $person->admin_id = $user->id;
        $person->notes = $request->notes;
        $person->area = $request->townCity;

        $area = new Area();
        $area->townCity = $request->townCity;

        $stored = $area->checkAreaExists($area);

        if(!$stored)
        {
            $area->save();
        } else
        {
            $area = $stored;
        }

        $person->address_id = $area->id;
        $person->save();
        $person->users()->attach($user->id, ['user_type' => 'Admin', "relation" => $request->relation]);

        if ($request->pathToPhoto != null)
        {
            $person->pathToPhoto = $request->pathToPhoto;
        }
        else
        {
            $file_path = "ticket_to_talk/storage/profile/p_" . $person->id .".jpg";
            $person->pathToPhoto = $file_path;
            $data = base64_decode($request->image);
//            $file = fopen(public_path($file_path), "wb");
//            fwrite($file, $data);
//            fclose($file);

            Storage::disk('s3')->put($file_path, $data);

            $person->imageHash = $request->imageHash;
        }

        $saved = $person->save();

        if (count(Period::find([1,2,3,4])) == 0)
        {
            $texts = ["Childhood", "Teenager", "Adult", "Retirement"];
            foreach ($texts as $text)
            {
                $period = new Period();
                $period->text = $text;
                $period->save();
            }
        }

        $person->periods()->attach([1,2,3,4]);

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
                ],500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @api {get} /people/show Get People
     * @apiName GetPeople
     * @apiGroup People
     *
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {String} message Server message
     * @apiSuccess {Person[]} person The user's people
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
     */
    public function show()
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
                "status" => 404,
                "message" => "Person not found",
            ],404
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
     * @api {post} /people/update Update a Person
     * @apiName UpdatePerson
     * @apiGroup People
     *
     * @apiParam {String} person_id Person's ID.
     * @apiParam {String} name Person's name.
     * @apiParam {String} birthYear Person's birth year.
     * @apiParam {String} birthPlace Person's birth place.
     * @apiParam {String} notes User's notes on the person.
     * @apiParam {String} townCity Where the person spent most of their life.
     * @apiParam {String} relation User's relation to the person.
     * @apiParam {byte[]} image Picture of the person.
     * @apiParam {String} imageHash SHA256 hash of the image byte array.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {String} message Update confirmation
     * @apiSuccess {Person} person The newly created person.
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

        $person = $user->people()->find($request->person_id);
//        $person = Person::find($request->person_id);

        $person->name = $request->name;
        $person->birthYear = $request->birthYear;
        $person->birthPlace = $request->birthPlace;
        $person->notes = $request->notes;
        $person->area = $request->area;

        $user->people()->updateExistingPivot($person->id, ['user_type' => $user->people()->find($request->person_id)->pivot->user_type, 'relation' => $request->relation], true);

        if ($request->imageHash != null)
        {
            $person->imageHash = $request->imageHash;
            $file_path = "ticket_to_talk/storage/profile/p_" . $person->id . ".jpg";
            $data = base64_decode($request->image);

            Storage::disk('s3')->put($file_path, $data);

            $person->pathToPhoto = $file_path;
        }

        $person->save();

        $person->pivot->relation = $request->relation;
        return response()->json(
            [
                "Status" => 200,
                "Message" => "Person updated",
                "Person" => $person
            ]
        );

    }


    /**
     * Destroys the record of the person.
     *
     * @api {delete} /people/destroy Delete a Person
     * @apiName DeletePerson
     * @apiGroup People
     *
     * @apiParam {String} person_id Person's ID.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {String} message Deletion confirmation
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
     */
    public function destroy()
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

        $person = Person::find(Input::get("person_id"));
        $person->delete();

        return response()->json(
            [
                "status" => 200,
                "message" => "person deleted."
            ]
        );
    }

    /**
     * @api {get} /people/getusers Get Person's Attached Users
     * @apiName PersonUsers
     * @apiGroup People
     *
     * @apiParam {String} person_id Person's ID.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {User[]} users Users attached to this person.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
     */
    public function getUsers()
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

        $personID = (int) Input::get('person_id');
        $person = Person::find($personID);

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

    /**
     * @api {get} /people/tickets Get a Person's Tickets
     * @apiName GetTicketsForPerson
     * @apiGroup People
     *
     * @apiParam {String} person_id Person's ID.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {Ticket[]} tickets Get a person's tickets.
     * @apiSuccess {Tag[]} tags Get tags for tickets.
     * @apiSuccess {TicketTag[]} ticket_tags Get ticket tag pairing.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
     */
    public function getTickets()
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

        $person_id = (int) Input::get('person_id');
        $person = $user->people->find($person_id);

        if($person)
        {
            $tickets = [];
            $tags = [];
            $ticket_tags = [];
            foreach($person->tickets as $ticket)
            {
                array_push($tickets, $ticket);
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
                    $ticket_tag =
                        [
                            "ticket_id" => $ticket->id,
                            "tag_id" => $tag->id
                        ];

                    array_push($ticket_tags, $ticket_tag);
                }
            }

            return response()->json(
                [
                    "status" => 200,
                    "tickets" => $tickets,
                    "tags" => $tags,
                    "ticket_tags" => $ticket_tags
                ]
            );
        } else
        {
            return response()->json(
                [
                    'message' => [
                        'status' => 'error'
                    ],
                        'errors' => [
                            'Resources could not be found'
                    ],
                    'data' => []],
                404
            );
        }
    }
}
