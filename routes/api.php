<?php

use App\Http\Controllers\API\ApiCreateOrderController;
use App\Http\Controllers\API\ApiProductController;
use App\Http\Controllers\API\ApiCategoryController;
use App\Http\Controllers\API\ApiTransactionHistoryController;
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


Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['token_auth']], function () {
    Route::get('/user',function (Request $request){
        return $request->user();
    });
    Route::get('/transaction-history', [ApiTransactionHistoryController::class, 'index']);
    Route::post('cancel-order/{orderId}', [ApiTransactionHistoryController::class, 'cancelOrder']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/create-order', [ApiCreateOrderController::class, 'store']);
});

Route::get('/', [ApiHomeController::class, 'index']);


Route::get('/get-categories', [ApiCategoryController::class, 'index']);
Route::get('/get-categories/{id}', [ApiCategoryController::class, 'show']);
Route::get('/get-product', [ApiProductController::class, 'index']);
Route::get('/get-product/{id}', [ApiProductController::class, 'show']);



