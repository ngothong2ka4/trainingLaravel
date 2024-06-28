<?php

use App\Http\Controllers\API\ApiProductController;
use App\Http\Controllers\API\ApiCategoryController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\ApiHomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::group(['middleware' => ['token_auth']], function () {
    Route::get('/user',function (Request $request){
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/', [ApiHomeController::class, 'index']);


Route::get('/get-categories', [ApiCategoryController::class, 'index']);
Route::get('/get-categories/{id}', [ApiCategoryController::class, 'show']);
Route::get('/get-product', [ApiProductController::class, 'index']);
Route::get('/get-product/{id}', [ApiProductController::class, 'show']);



