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

    public function __construct(User $user, JWTAuth $jwtauth)
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user) {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated.",
                ], 401
            );
        }

        // AES-256-CBC

        $iv = bin2hex(openssl_random_pseudo_bytes(8));
        $notes = openssl_encrypt($request->notes, env('ENC_SCHEME'), env('AES_KEY'), 0, $iv);
        $year = openssl_encrypt($request->birthYear, env('ENC_SCHEME'), env('AES_KEY'), 0, $iv);
        $place = openssl_encrypt($request->birthPlace, env('ENC_SCHEME'), env('AES_KEY'), 0, $iv);
        $area = openssl_encrypt($request->townCity, env('ENC_SCHEME'), env('AES_KEY'), 0, $iv);


        $person = new Person();
        $person->name = $request->name;
        $person->birthYear = $year;
        $person->birthPlace = $place;
        $person->admin_id = $user->id;
        $person->notes = $notes;
        $person->area = $area;
        $person->iv = $iv;


        $area = new Area();
        $area->townCity = $request->townCity;

        $stored = $area->checkAreaExists($area);

        if (!$stored) {
            $area->save();
        } else {
            $area = $stored;
        }

        $person->address_id = $area->id;
        $person->save();
        $person->users()->attach($user->id, ['user_type' => 'Admin', "relation" => $request->relation]);

        if ($request->pathToPhoto != null) {
            $person->pathToPhoto = $request->pathToPhoto;
        } else {
            $file_path = "ticket_to_talk/storage/profile/p_" . $person->id . ".jpg";
            $person->pathToPhoto = $file_path;
            $data = base64_decode($request->image);

            Storage::disk('s3')->put($file_path, $data);

            $person->imageHash = $request->imageHash;
        }

        $saved = $person->save();

        if (count(Period::find([1, 2, 3, 4])) == 0) {
            $texts = ["Childhood", "Teenager", "Adult", "Retirement"];
            foreach ($texts as $text) {
                $period = new Period();
                $period->text = $text;
                $period->save();
            }
        }

        $person->periods()->attach([1, 2, 3, 4]);

        if ($saved) {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Person saved",
                            "code" => 200
                        ],
                    "errors" => false,
                    "data" =>
                        [
                            "person" => $person->decryptPerson(),
                            'owner' => $user
                        ]
                ]
            );
        } else {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Error saving person",
                            "code" => 500
                        ],
                    "errors" => false,
                    "data" =>
                        [
                            "person" => $person
                        ]
                ], 500
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

        if (!$user) {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated.",
                ], 401
            );
        }

        $person = Person::find(Input::get('person_id'));

        if (!$person) {
            return response()->json(
                [
                    "status" => 404,
                    "message" => "Person not found",
                ], 404
            );
        }
        if ($user->can('view', $person)) {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Person Found",
                            "code" => 200,
                        ],
                    "errors" => false,
                    "data" =>
                        [
                            "person" => $person->decryptPerson()
                        ],
                ]
            );
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
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

        if (!$user) {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "User not authenticated.",
                            "code" => 401
                        ],
                    "errors" => true,
                    "data" => []
                ], 401
            );
        }

        $person = $user->people->find($request->person_id);
        $person = $person->decryptPerson();

        if ($user->can('view', $person)) {

            $person->name = $request->name;
            $person->birthYear = $request->birthYear;
            $person->birthPlace = $request->birthPlace;
            $person->notes = $request->notes;
            $person->area = $request->area;

            $user->people()->updateExistingPivot($person->id, ['user_type' => $user->people()->find($request->person_id)->pivot->user_type, 'relation' => $request->relation], true);

            if ($request->imageHash != null) {
                $person->imageHash = $request->imageHash;
                $file_path = "ticket_to_talk/storage/profile/p_" . $person->id . ".jpg";
                $data = base64_decode($request->image);

                Storage::disk('s3')->put($file_path, $data);

                $person->pathToPhoto = $file_path;
            }

            $p_enc = $person->encryptPerson();
            $p_enc->save();

            $person->pivot->relation = $request->relation;


            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Person updated",
                            "code" => 200
                        ],
                    "errors" => false,
                    "data" =>
                        [
                            "person" => $person->decryptPerson()
                        ]
                ]
            );
        } else {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Unauthorised for resource",
                            "code" => 403
                        ],
                    'errors' => true,
                    "data" => []
                ], 403
            );
        }
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

        if (!$user) {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "User not authenticated.",
                            "code" => 401
                        ],
                    "errors" => true,
                    "data" => []
                ], 401
            );
        }

        $person = Person::find(Input::get("person_id"));
        if (!$person) {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "User not authenticated.",
                            "code" => 404
                        ],
                    "errors" => true,
                    "data" => []
                ], 404
            );
        }
        if ($user->can('delete', $person)) {
            $person->delete();

            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Person deleted",
                            "code" => 200
                        ],
                    'errors' => false,
                    "data" => []
                ], 200
            );
        } else {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Unauthorised for resource",
                            "code" => 403
                        ],
                    'errors' => true,
                    "data" => []
                ], 403
            );
        }
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

        if (!$user) {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "User not authenticated.",
                            "code" => 401
                        ],
                    "errors" => true,
                    "data" => []
                ], 401
            );
        }

        $person = Person::find((int)Input::get('person_id'));
        if (!$person) {
            return response()->json(
                [
                    "status" => [
                        "message" => "Resource not found",
                        "code" => 404
                    ],
                    'errors' => true,
                    "data" => [],
                ], 404
            );
        }

        if ($user->can('view', $person)) {
            $users = $person->users;
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "Users found",
                            "code" => 200
                        ],
                    "errors" => false,
                    "data" =>
                        [
                            "users" => $users
                        ]
                ]
            );
        } else {
            return response()->json(
                [
                    "status" => [
                        "message" => "User not authorised for resource",
                        "code" => 403
                    ],
                    'errors' => true,
                    "data" => [],
                ], 403
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

        if (!$user) {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "User not authenticated.",
                            "code" => 401
                        ],
                    "errors" => true,
                    "data" => []
                ], 401
            );
        }

        $person = Person::find(Input::get('person_id'));

        if (!$person) {
            return response()->json(
                [
                    "status" => [
                        "message" => "Resource not found",
                        "code" => 404
                    ],
                    'errors' => true,
                    "data" => [],
                ], 404
            );
        }

        if ($user->can('view', $person)) {
            $tickets = [];
            $tags = [];
            $ticket_tags = [];
            foreach ($person->tickets as $ticket) {
                if ($user->can('view', $ticket)) {
                    array_push($tickets, $ticket);
                    foreach ($ticket->tags as $tag) {
                        $already_added = false;
                        foreach ($tags as $t) {
                            if ($t == $tag) {
                                $already_added = true;
                            }
                        }
                        if (!$already_added) {
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
            }

            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "success",
                            "code" => 200,
                        ],
                    "errors" => false,
                    "data" =>
                    [
                        "tickets" => $tickets,
                        "tags" => $tags,
                        "ticket_tags" => $ticket_tags
                    ],
                    200
                ]
            );
        } else {
            return response()->json(
                [
                    "status" => [
                        "message" => "User not authorised for resource",
                        "code" => 403
                    ],
                    'errors' => true,
                    "data" => [],
                ], 403
            );
        }
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

        $id = Input::get('person_id');

        if ($user->can('view', Person::find($id))) {
            $fileName = 'p_' . $id . '.jpg';

            $file_type = 'image/jpeg';

            $exists = Storage::disk('s3')->exists($fileName);
            if ($exists) {
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
        } else {
            return response()->json(
                [
                    "Status" => 403,
                    "Message" => "Unauthorised for resource"
                ], 403
            );
        }
    }
}
