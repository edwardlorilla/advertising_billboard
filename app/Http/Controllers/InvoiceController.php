<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Invoice::with('billboardhired.subject')->search(request('search'))->get());
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
        return response()->json(Invoice::with('billboardhired.subject')->whereHas('billboardhired' , function ($query){
            $query->whereHas('agency', function ($q){
                $q->where('details', 'like', "%".request('search')."%");
            })->orWhereHas('client', function ($q){
                $q->where('details', 'like', "%".request('search')."%");
            });
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
            'details' =>'required',
            'billboardhired_id' =>'required'
        ]);
        $invoice = new Invoice;
        $invoice->details = $input['details'];
        $invoice->billboardhired_id = $input['billboardhired_id'];
        $invoice->save();
        return response()->json($invoice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return response()->json($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $input = $request->validate([
            'details' =>'required',
            'billboardhired_id' =>'required'
        ]);
        $invoice->details = $input['details'];
        $invoice->billboardhired_id = $input['billboardhired_id'];
        $invoice->save();
        return response()->json($invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
