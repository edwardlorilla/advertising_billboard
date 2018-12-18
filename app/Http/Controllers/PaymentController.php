<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Payment::with('invoice.billboardhired.subject')->whereHas('invoice', function ($query){
            $query->whereHas('billboardhired', function ($q){
                $q->whereHas('agency', function ($agency){
                    $agency->where('details', 'like', "%".request('search')."%");
                })->orWhereHas('client', function ($client){
                    $client->where('details', 'like', "%".request('search')."%");
                });
            });
        })->get());
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
        $input = $request->validate([
            'invoice_id' => 'required',
            'details' => 'required',
        ]);
        $payment = new Payment;
        $payment->invoice_id = $input['invoice_id'];
        $payment->details = $input['details'];
        $payment->save();
        return response()->json($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return response()->json($payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $input = $request->validate([
            'invoice_id' => 'required',
            'details' => 'required',
        ]);

        $payment->invoice_id = $input['invoice_id'];
        $payment->details = $input['details'];
        $payment->save();
        return response()->json($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        return response()->json($payment->delete());
    }
}
