<?php

namespace App\Http\Controllers\Api;

use App\Inspiration;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @api {get} /inspiration/get Get Inspirations
     * @apiName GetInspirations
     * @apiGroup Inspiration
     *
     * @apiParam {JWTAuthToken} token The session token
     *
     * @apiSuccess {Inspiration[]} Inspirations Array of Inspirations.
     *
     * @apiError 401 User could not be authenticated
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspirations = Inspiration::all();
        return response()->json(
            [
                "Inspirations" => $inspirations
            ],
            200
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
