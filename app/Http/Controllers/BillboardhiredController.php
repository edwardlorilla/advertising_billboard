<?php

namespace App\Http\Controllers;

use App\Billboardhired;
use Illuminate\Http\Request;

class BillboardhiredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Billboardhired::with('billboard', 'subject')->search(request('search'))->get());
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
        return response()->json(Billboardhired::with('subject')->whereHas('agency', function ($query){
            $query->where('details', 'like', "%".request('search')."%");
        })->orWhereHas('client', function ($query){
            $query->where('details', 'like', "%".request('search')."%");
        })->get());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'billboard_id' => 'required',
            'billboardpartytype' => 'required',
            'date_hired_from' => 'required',
            'date_hired_to' => 'required',
            'type' => 'required'
        ]);

        $billboardhired = new Billboardhired;
        $billboardhired->billboard_id = $input['billboard_id'];
        $billboardhired->subject_id = $input['type'];
        $billboardhired->subject_type = $input['billboardpartytype'] == 'clients' ? 'App\\Client' : 'App\\Agency';
        $billboardhired->date_hired_from = $input['date_hired_from'];
        $billboardhired->date_hired_to = $input['date_hired_to'];
        $billboardhired->save();
        return response()->json($billboardhired);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Billboardhired  $billboardhired
     * @return \Illuminate\Http\Response
     */
    public function show(Billboardhired $billboardhired)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Billboardhired  $billboardhired
     * @return \Illuminate\Http\Response
     */
    public function edit(Billboardhired $billboardhired)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Billboardhired  $billboardhired
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billboardhired $billboardhired)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Billboardhired  $billboardhired
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billboardhired $billboardhired)
    {
        //
    }
}
