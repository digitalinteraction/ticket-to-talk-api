<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use App\Person;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

class ConversationController extends Controller
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

        $conversations = Conversation::where("person_id", Input::get('person_id'))->get();

        foreach ($conversations as $conversation)
        {
            $ticket_id_string = "";
            foreach ($conversation->tickets as $ticket)
            {
                $ticket_id_string = $ticket_id_string . $ticket->id . ' ';
            }

            $conversation->ticket_id_string = $ticket_id_string;
        }

        return response()->json(
            [
                "status" => 200,
                "conversations" => $conversations
            ]
        );
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

        $dt = explode(" ", $request->date);
        $date = explode("/", $dt[0]);
        $time = explode(":", $dt[1]);

        $conversation = new Conversation();
        $conversation->date = Carbon::create($date[2], $date[1], $date[0], $time[0], $time[1], $time[2]);
        $conversation->notes = $request->notes;
        $conversation->person_id = $request->person_id;
        $conversation->save();

        $conversation->date = $request->date;

        return response()->json(
            [
                "status" => 200,
                "conversation" => $conversation
            ]
        );

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
     * Delete the conversation
     *
     * @return \Illuminate\Http\JsonResponse
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
                ]
            );
        }

        $conversation_id = Input::get('conversation_id');
        $conversation = Conversation::find($conversation_id);
        $conversation->delete();

        return response()->json(
            [
                "status" => 200,
                "message" => "conversation deleted."
            ]
        );
    }

    /**
     * Add a ticket to the conversation
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTicket(Request $request)
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

        $conversation = Conversation::find($request->conversation_id);
        $conversation->tickets()->attach($request->ticket_id);

        return response()->json(
            [
                "status" => 200,
                "message" => "ticket added to conversation"
            ]
        );
    }

    /**
     * Removes a ticket from the conversation
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeTicket(Request $request)
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

        $conversation = Conversation::find($request->conversation_id);
        $conversation->tickets()->detach($request->ticket_id);

        return respsone()->json(
            [
                "status" => 200,
                "message" => "ticket removed from conversation"
            ]
        );
    }
}
