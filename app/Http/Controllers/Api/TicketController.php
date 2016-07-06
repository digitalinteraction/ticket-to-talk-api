<?php

namespace App\Http\Controllers\Api;

use App\Area;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

class TicketController extends Controller
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
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 402,
                    "Message" => "User not authenticated."
                ]
            );
        }

        $temp_ticket = new Ticket();
        $temp_ticket->title = $request['ticket']['title'];

        $tags = [];
        foreach($request['tags'] as $tag)
        {
            array_push($tags, $tag);
        }

//        return response()->json(
//            [
//                "tags" => $tags
//            ]
//        );

        $ticket = new Ticket();
        $ticket->title = $request['ticket']['title'];
        $ticket->description = $request['ticket']['description'];
        $ticket->mediaType = $request['ticket']['mediaType'];
        $ticket->year = $request['ticket']['year'];
        $ticket->pathToFile = $request['ticket']['pathToFile'];
        $ticket->access_level = $request['ticket']['access_level'];
        $saved = $ticket->save();

        $area = new Area();
        $area->townCity = $request['area']['town_city'];
        $area->county = $request['area']['county'];
        $area->country = $request['area']['country'];
        $area->save();

        // TODO: attach ticket to person with privilege level
        $person = Person::find($request->person_id);
        $ticket->person()->associate($ticket->id);
        $ticket->users()->attach($user->id, ['user_type' => 'admin']);
        $ticket->area()->associate($area->id);

        if ($saved) {
            return response()->json(
                [
                    "status" => 200,
                    "message" => "Tag saved",
                    "ticket" => $ticket,
                    'owner' => $user
                ]
            );
        } else
        {
            return response()->json(
                [
                    "status" => 500,
                    "message" => "Error saving ticket",
                    "ticket" => $ticket
                ]
            );
        }
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
}
