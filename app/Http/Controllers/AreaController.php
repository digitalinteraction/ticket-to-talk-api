<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

use App\Http\Requests;

class AreaController extends Controller
{
    /**
     * Show all areas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $allAreas = Area::all();
        return response()->json(
            [
                "areas" => $allAreas
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
        dd($request->json()->all());
    }

    /**
     * Get area by ID.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);
        return response()->json(
            [
                "area" => $area
            ]
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
