<?php

namespace App\Http\Controllers\Api;

use App\Area;
use App\Period;
use App\Tag;
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
                    "Status" => 401,
                    "Message" => "User not authenticated."
                ]
            );
        }

        $temp_ticket = new Ticket();
        $temp_ticket->title = $request['ticket']['title'];

        $tags = [];
        foreach($request['tags'] as $tag)
        {
            array_push($tags, $tag["id"]);
        }

        $area = new Area();
        $area->townCity = $request['area']['townCity'];

        $stored = $area->checkAreaExists($area);

        if(!$stored)
        {
            $area->save();
        } else
        {
            $area = $stored;
        }

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

        $ticket = new Ticket();
        $ticket->title = $request['ticket']['title'];
        $ticket->description = $request['ticket']['description'];
        $ticket->mediaType = $request['ticket']['mediaType'];
        $ticket->year = $request['ticket']['year'];
        $ticket->pathToFile = "null_path";
        $ticket->access_level = $request['ticket']['access_level'];
        $ticket->person_id = $request['ticket']['person_id'];
        $ticket->area_id = $area->id;
        $ticket->period_id = $period->id;
        $ticket->save();

        $ticket->tags()->attach($tags);

        $ticket->users()->attach($user->id, ['user_type' => 'admin']);

        if (strcmp($ticket->mediaType, "Photo") == 0) 
        {
            $file_path = "storage/photo/t_" . $ticket->id .".jpg";
            $data = base64_decode($request->image);
            $file = fopen($file_path, "wb");
            fwrite($file, $data);
            fclose($file);
            $ticket->pathToFile = $file_path;
            $ticket->save();
        } else if (strcmp($ticket->mediaType, "Song") == 0)
        {
            $file_path = "storage/audio/t_" . $ticket->id .".wav";
            $data = base64_decode($request->image);
            $file = fopen($file_path, "wb");
            fwrite($file, $data);
            fclose($file);
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
                    "area" => $area
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
