<?php

namespace App\Http\Controllers;

use App\Billboard;
use Illuminate\Http\Request;

class BillboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Billboard::search(request('search'))->get());
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

    public function search()
    {
        return response()->json(Billboard::search(request('search'))->get());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'details' => 'required'
        ]);
        $billboard = new Billboard;
        $billboard->details = $input['details'];
        $billboard->save();
        return response()->json($billboard);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Billboard $billboard
     * @return \Illuminate\Http\Response
     */
    public function show(Billboard $billboard)
    {
        return response()->json($billboard);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Billboard $billboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Billboard $billboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Billboard $billboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billboard $billboard)
    {
        $input = $request->validate([
            'details' => 'required'
        ]);
        $billboard->details = $input['details'];
        $billboard->save();
        return response()->json($billboard);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Billboard $billboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billboard $billboard)
    {
        return response()->json($billboard);
    }
}
