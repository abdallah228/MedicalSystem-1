<?php

use App\Http\Controllers\Mobile\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//registerClient
Route::group(['prefix'=>'client'],function(){
    Route::group(['middleware'=>'auth:client'],function(){
    Route::get('logout',[ClientController::class,'logout']);//
    Route::get('profile',[ClientController::class,'profile']);//


    //listDeliviries
    Route::get('deliviries',[ClientController::class,'deliviries']);//
    //list of ads
    Route::get('ads',[ClientController::class,'ads']);//
    //my orders
    Route::get('orders',[ClientController::class,'orders']);//
    });

    Route::post('register',[ClientController::class,'register']);//
    Route::post('login',[ClientController::class,'login']);//

});



