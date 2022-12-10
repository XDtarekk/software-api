<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\FlightController;

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

Route::get('/Flight', [FlightController::class, 'index']);
Route::put('/show-Flights/{id}', [FlightController::class, 'show']);
Route::post('/add-Flight', [FlightController::class, 'store']);
Route::put('/update-Flights/{id}', [FlightController::class, 'update']);
Route::delete('/delete-Flights/{id}', [FlightController::class, 'destroy']);

Route::get('/Customer', [AuthController::class, 'index']);
Route::post('/add-Customer', [CustomerController::class, 'store']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::group(
['middleware'=>['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    //get the logged in customer's data
    Route::post('/logged-Customer', [AuthController::class, 'show']);
    //cart routes
    Route::post('/add-to-cart', [\App\Http\Controllers\API\CartController::class, 'add']);
    //show products added to cart in cart page
    Route::get('/cart', [\App\Http\Controllers\API\CartController::class, 'show']);
    //delete a single item from cart
    Route::delete('/delete-item/{$cart_id}',[\App\Http\Controllers\API\CartController::class, 'deleteItem'] );
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
