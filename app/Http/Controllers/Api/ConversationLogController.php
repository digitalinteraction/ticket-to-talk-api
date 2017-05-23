<?php

namespace App\Http\Controllers\Api;

use App\ConversationLog;
use App\TicketLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

class ConversationLogController extends Controller
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
            abort(401);
        }

        if (!$user->in_study)
        {
            return response()->json(
                [
                    "status" =>
                        [
                            "message" => "",
                            "code" => 200
                        ],
                    "errors" => false,
                    "data" =>
                        [
                        ]
                ]
            );
        }

        $js = \GuzzleHttp\json_encode($request->conversationLog);
        $j = \GuzzleHttp\json_decode($js);

        $r_ticket_logs = $j->TicketLogs;

        $ticket_logs = [];
        foreach ($r_ticket_logs as $r_ticket_log)
        {
            $ticket_log = new TicketLog();
            $ticket_log->ticket_id = $r_ticket_log->TicketId;
            $ticket_log->start = new Carbon($r_ticket_log->Start);
            $ticket_log->finish = new Carbon($r_ticket_log->Finish);
            $ticket_log->user_id = $user->id;
            array_push($ticket_logs, $ticket_log);
        }

        $conversationLog = new ConversationLog();
        $conversationLog->start = new Carbon($j->Start);
        $conversationLog->finish = new Carbon($j->Finish);
        $conversationLog->conversation_id = $j->ConversationId;
        $conversationLog->user_id = $user->id;

        $conversationLog->save();

        foreach ($ticket_logs as $ticket_log)
        {
            $ticket_log->conversation_log_id = $conversationLog->id;
            $ticket_log->save();
        }

        return response()->json(
            [
                "status" =>
                    [
                        "message" => "",
                        "code" => 200
                    ],
                "errors" => false,
                "data" =>
                    [
                    ]
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
