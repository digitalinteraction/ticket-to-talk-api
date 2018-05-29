<?php

namespace App\Http\Controllers\Api;

use App\Consent;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\JWTAuth;

class ConsentController extends Controller
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
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user) {
            abort(401);
        }

        $consents = Consent::where('userID', $user->id)->orderBy('created_at', 'desc')->first()->get();

        return response()->json([
            "status" => [
                "message" => "",
                "code" => 200
            ],
            "errors" => false,
            "data" => [
                "consent" => $consents
            ]
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = Input::get('token');
        $user = $this->jwtauth->authenticate($token);

        if (!$user) {
            abort(401);
        }

        $consent = new Consent;
        $consent->core = true;
        $consent->subscribed = true;
        $consent->research = true;
        $consent->googleAnalytics = true;
        $consent->userID = $user->id;

        $consent->save();

        return response()->json([
            "status" => [
                "message" => "",
                "code" => 200
            ],
            "errors" => false,
            "data" => [
                "consent" => $consent
            ]
        ]);
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
