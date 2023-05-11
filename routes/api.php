<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//DEPARTMENT CONTROLLER
Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('department/import', 'DepartmentController@import');
});

//ITEM CONTROLLER
Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('item/import', 'ItemsController@import');
});

//CATEGORY CONTROLLER
Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('category/import', 'CategoryController@import');
});

//PURCHASE REQUEST CONTROLLER
Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('purchase_request/import', 'PurchaseRequestController@import');
});

//PURCHASE ORDER CONTROLLER
Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('purchase_order/import', 'PurchaseOrderController@import');
});


//DELIVERY ORDER
Route::namespace('App\Http\Controllers') -> group(function(){
    Route::get('delivery', 'DeliveryController@index');
});


//ISSUANCE 
Route::namespace('App\Http\Controllers') -> group(function(){
    Route::get('issuance', 'IssuanceController@index');
});