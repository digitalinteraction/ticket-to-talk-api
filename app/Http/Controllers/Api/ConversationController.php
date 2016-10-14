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
     * @api {get} /conversations/get Get User's Conversations
     * @apiName GetConversations
     * @apiGroup Conversations
     *
     * @apiParam {String} person_id The id of the person the conversations are for.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {Conversation[]} conversations The conversations attached to the person.
     *
     * @apiError 500 Person could not be found
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
     * @api {post} /conversations/store Save a Conversation
     * @apiName StoreConversation
     * @apiGroup Conversations
     *
     * @apiParam {String} datetime String representation of the conversation date-time.
     * @apiParam {String} platform The OS the request is sent from (Android or iOS).
     * @apiParam {String} notes The user's notes on the conversation.
     * @apiParam {String} person_id ID of the person this conversation is for.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {Conversation} conversation The newly created conversation.
     *
     * @apiError 401 User could not be authenticated
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

        $dt = explode(" ", $request->datetime);

        $date = explode("/", $dt[0]);
        $time = explode(":", $dt[1]);

        $date[0] = (int)$date[0];

        for($i = 0; $i < count($date); $i++)
        {
            $date[$i] = (int)$date[$i];
        }

        for($i = 0; $i < count($time); $i++)
        {
            $time[$i] = (int)$time[$i];
        }

        $conversation = new Conversation();
        if (strcmp("Android", $request->platform) == 0)
        {
//            $conversation->date = Carbon::create($date[2], $date[0], $date[1], $time[0], $time[1], $time[2], 'Europe/London');
            $conversation->date = $request->datetime;
        }
        else
        {
//            $conversation->date = Carbon::create($date[2], $date[0], $date[1], $time[0], $time[1], $time[2], 'Europe/London');
            $conversation->date = $request->datetime;
        }

        $conversation->notes = $request->notes;
        $conversation->person_id = $request->person_id;
        $conversation->save();

//        $conversation->date = $request->datetime;

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
     * @api {post} /conversations/update Update a Conversation
     * @apiName UpdateConversation
     * @apiGroup Conversations
     *
     * @apiParam {String} conversation_id Conversation identifier.
     * @apiParam {String} notes The user's notes on the conversation.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {Conversation} Conversation The updated conversation.
     *
     * @apiError 500 Conversation not found
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
                    "Message" => "User not authenticated.",
                ],401
            );
        }

        $conversation = Conversation::find($request->conversation_id);
        if (!$conversation)
        {
            return response()->json(
                [
                    "Status" => 500,
                    "Message" => "Conversation not found",
                ],500
            );
        }

        $conversation->notes = $request->notes;
        $conversation->save();

        return response()->json(
            [
                "Status" => 200,
                "Message" => "Conversation updated",
                "Conversation" => $conversation
            ]
        );
    }

    /**
     * Delete the conversation
     *
     * @api {get} /conversations/destroy Delete a Conversation
     * @apiName DeleteConversation
     * @apiGroup Conversations
     *
     * @apiParam {String} conversation_id Conversation identifier.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} Status The response code
     * @apiSuccess {String} Message Deletion confirmation
     *
     * @apiError 500 Conversation not found
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
     * @api {post} /conversations/tickets/add Add a Ticket to a Conversation
     * @apiName AddTicketToConversation
     * @apiGroup Conversations
     *
     * @apiParam {String} conversation_id Conversation identifier.
     * @apiParam {String} ticket_id Ticket identifier.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {String} message Deletion confirmation
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
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
                ],401
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
     * @api {post} /conversations/tickets/remove Remove a Ticket from a Conversation
     * @apiName RemoveTicketFromConversation
     * @apiGroup Conversations
     *
     * @apiParam {String} conversation_id Conversation identifier.
     * @apiParam {String} ticket_id Ticket identifier.
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {String} status The response code
     * @apiSuccess {String} message Deletion confirmation
     *
     * @apiError 500 Resource not found
     * @apiError 401 User could not be authenticated
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

        return response()->json(
            [
                "status" => 200,
                "message" => "ticket removed from conversation"
            ]
        );
    }
}
