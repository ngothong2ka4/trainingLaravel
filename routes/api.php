<?php

use App\Http\Controllers\API\ApiProductController;
use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;use App\Http\Controllers\Auth\LoginController;

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


Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user',function (Request $request){
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/get-product', [ApiProductController::class, 'index']);
Route::get('/get-product/{id}', [ApiProductController::class, 'show']);



