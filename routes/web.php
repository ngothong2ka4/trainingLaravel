<?php

use App\Http\Controllers\PageDetailProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\Fe\HomeController;

use App\Http\Controllers\Auth\Client\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('index');
//})->name('homePage');
Route::get('/', [HomeController::class,'index'])->name('homePage');
Route::get('/404', function () {
    return view('fe.404');
})->name('page404');

Route::get('/about', function () {
    return view('about');
});
Route::get('/login', function () {
    return view('fe.auth.login');
});
Route::get('/listorder', function () {
    return view('fe.listorder.listOrder');
});
/**
 * Auth Routes
 */

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::group(['prefix' => 'cms'], function() {
        Auth::routes(['verify' => false]);

            Route::middleware(['auth','isAdmin'])->group(function () {

                Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
                //User
                Route::group(['prefix' => 'users'], function () {
                    Route::get('/', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
                    Route::get('/create', 'UsersController@create')->name('users.create');
                    Route::post('/create', 'UsersController@store')->name('users.store');
                    Route::get('/{user}/show', 'UsersController@show')->name('users.show');
                    Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
                    Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
                    Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
                });

                //Product
                Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
                Route::get('/',[ProductController::class,'index'])->name('index');
                Route::get('/add-product',[ProductController::class,'create'])->name('create');
                Route::post('/add-product',[ProductController::class,'store'])->name('store');
                Route::get('/show-product/{id}',[ProductController::class,'show'])->name('show');
                Route::get('/update-product/{id}',[ProductController::class,'edit'])->name('edit');
                Route::patch('/add-product',[ProductController::class,'store'])->name('update');
                Route::delete('/delete-product/{product}',[ProductController::class,'destroy'])->name('destroy');
                });
                Route::group(['prefix' => 'categories'], function () {
                    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
                    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
                    Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
                    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
                    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
                    Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
                    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
                });
                Route::group(['prefix' => 'order'], function () {
                    Route::get('/', [OrderController::class, 'index'])->name('order.index');
                    Route::get('/{id}', [OrderController::class, 'show'])->name('order.show');
                    Route::get('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
                    Route::get('/orders/{id}/done', [OrderController::class, 'done'])->name('order.done');
                });
        });
    });
    Route::group(['prefix' => 'fe'], function() {

    });
});

Route::get('/detail-product/{id}',[PageDetailProductController::class, 'show'])->name('detail-product');

Route::fallback(function() {
    return redirect()->route('page404');
});
