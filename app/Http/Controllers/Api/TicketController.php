<?php

namespace App\Http\Controllers\Api;

use App\Period;
use App\Tag;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
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
     * @api {post} /tickets/store Save a Ticket
     * @apiName SaveTicket
     * @apiGroup Tickets
     *
     * @apiParam {Ticket} ticket The ticket to save.
     * @apiParam {Period} period Period of life the ticket is from.
     * @apiParam {byte[]} media Byte array of the file attached to the ticket.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {String} message Update confirmation
     * @apiSuccess {Ticket} ticket The newly created ticket.
     * @apiSuccess {User} user The owner of the ticket.
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
                    "Message" => "User not authenticated."
                ],401
            );
        }

//        $temp_ticket = new Ticket();
//        $temp_ticket->title = $request['ticket']['title'];

//        $tags = [];
//        foreach($request['tags'] as $tag)
//        {
//            array_push($tags, $tag["id"]);
//        }

//        $area = new Area();
//        $area->townCity = $request['area']['townCity'];
//
//        $stored = $area->checkAreaExists($area);
//
//        if(!$stored)
//        {
//            $area->save();
//        } else
//        {
//            $area = $stored;
//        }

        $period = new Period();
        $period->text = $request['period']['text'];

        $stored = $period->checkPeriodExists($period);
        if(!$stored)
        {
            $period->save();
        } else
        {
            $period = $stored;
        }

//        return response()->json(["message" => "passed"]);

        $ticket = new Ticket();
        $ticket->title = $request['ticket']['title'];
        $ticket->description = $request['ticket']['description'];
        $ticket->mediaType = $request['ticket']['mediaType'];
        $ticket->year = $request['ticket']['year'];
        $ticket->pathToFile = "null_path";
        $ticket->access_level = $request['ticket']['access_level'];
        $ticket->person_id = $request['ticket']['person_id'];
//        $ticket->area_id = $area->id;
        $ticket->area = $request['ticket']['area'];
        $ticket->period_id = $period->id;
        $ticket->save();

//        $ticket->tags()->attach($tags);

        $ticket->users()->attach($user->id, ['user_type' => 'admin']);

        if(strcmp("YouTube", $request['ticket']['mediaType']) == 0)
        {
            $ticket->pathToFile = $request['ticket']['pathToFile'];
            $ticket->save();
        }
        else
        {
            $file_path = "";
            switch ($request['ticket']['mediaType'])
            {
                case "Sound":
                    $file_path = "ticket_to_talk/storage/audio/t_" . $ticket->id .".wav";
                    break;
                case "Picture":
                    $file_path = "ticket_to_talk/storage/photo/t_" . $ticket->id .".jpg";
                    break;
                case "Video":
                    break;
            }

            $data = base64_decode($request->media);
            Storage::disk('s3')->put($file_path, $data);

//            $file = fopen($file_path, "wb");
//            fwrite($file, $data);
//            fclose($file);

            $ticket->pathToFile = $file_path;
            $ticket->save();
        }

        if ($ticket->id != 0) {
            return response()->json(
                [
                    "status" => 200,
                    "message" => "Ticket saved",
                    "ticket" => $ticket,
                    'owner' => $user,
                ]
            );
        } else
        {
            return response()->json(
                [
                    "status" => 500,
                    "message" => "Error saving ticket",
                    "ticket" => $ticket
                ],500
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
     * @api {post} /tickets/update Update a Ticket
     * @apiName UpdateTicket
     * @apiGroup Tickets
     *
     * @apiParam {String} ticket_id The ticket id.
     * @apiParam {String} title The ticket title.
     * @apiParam {String} description The ticket description.
     * @apiParam {String} year The year the file is from.
     * @apiParam {String} access_level Which user group can access the ticket.
     * @apiParam {String} period_id The id of the period the ticket is from.
     * @apiParam {String} area Where the ticket is from.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {String} message Update confirmation
     * @apiSuccess {Ticket} ticket The newly created ticket.
     * @apiSuccess {User} user The owner of the ticket.
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
     */
    public function update(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user)
        {
            return response()->json(
                [
                    "Status" => 401,
                    "Message" => "User not authenticated."
                ],401
            );
        }

        $ticket = Ticket::find($request->ticket_id);
        if (!$ticket)
        {
            return response()->json(
                [
                    "Status" => 404,
                    "Message" => "Ticket not found"
                ],404
            );
        }

        $period = new Period();
        $period->text = $request->period;

        $stored = $period->checkPeriodExists($period);
        if(!$stored)
        {
            $period->save();
        } else
        {
            $period = $stored;
        }

//        $area = new Area();
//        $area->townCity = $request->area;
//
//        $stored = $area->checkAreaExists($area);
//
//        if($stored == null)
//        {
//            $area->save();
//        } else
//        {
//            $area = $stored;
//        }

        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->year = $request->year;
        $ticket->access_level = $request->access_level;
        $ticket->period_id = $period->id;
//        $ticket->area_id = $area->id;
        $ticket->area = $request->area;

        $saved = $ticket->save();
        if ($saved)
        {
            return response()->json(
                [
                    "Status" => 200,
                    "Message" => "Ticket updated",
                    "Ticket" => $ticket,
//                    "Area" => $area
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    "Status" => 500,
                    "Message" => "Ticket could not be saved."
                ],404
            );
        }
    }

    /**
     * @api {delete} /tickets/destroy Delete a Ticket
     * @apiName DeleteTicket
     * @apiGroup Tickets
     *
     * @apiParam {String} ticket_id The ticket id.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {String} message Update confirmation
     * @apiSuccess {Ticket} ticket The newly created ticket.
     * @apiSuccess {User} user The owner of the ticket.
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
                    "Message" => "User not authenticated."
                ],401
            );
        }

        $ticket = Ticket::find(Input::get('ticket_id'));
        $ticket->delete();

        return response()->json(
            [
                "status" => 200,
                "message" => "Ticket deleted"
            ]
        );

    }
}
