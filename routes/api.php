<?php

use App\Http\Controllers\ContactController as ContactController;
use App\Http\Controllers\ProductController as ProductController;
use App\Http\Controllers\PurchaseController as PurchaseController;
use App\Http\Controllers\UserController as UserController;
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
Route::namespace('api')->group(function () {
    Route::prefix('customers')->group(function (){
       Route::post('create',[ContactController::class,'createCustomer']);
       Route::post('list',[ContactController::class,'getCustomers']);

    });
    Route::prefix('users')->group(function (){
        Route::post('auth',[UserController::class,'auth']);

    });
    Route::prefix('products')->group(function (){
        Route::post('create',[ProductController::class,'createProduct']);
        Route::get('list',[ProductController::class,'listProduct']);

    });
    Route::prefix('purchase')->group(function (){
        Route::post('create',[PurchaseController::class,'createPurchase']);
        Route::post('list',[PurchaseController::class,'listPurchase']);

    });
});
