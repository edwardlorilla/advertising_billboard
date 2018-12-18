<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/agencies/search', 'AgencyController@search');
Route::get('/clients/search', 'ClientController@search');
Route::get('/billboardhireds/search', 'BillboardhiredController@search');
Route::get('/billboards/search', 'BillboardController@search');
Route::get('/invoices/search', 'InvoiceController@search');
Route::apiResources([
    '/agencies' => 'AgencyController',
    '/billboards' => 'BillboardController',
    '/clients' => 'ClientController',
    '/invoices' => 'InvoiceController',
    '/payments' => 'PaymentController',
    '/billboardhireds' => 'BillboardhiredController'
]);