<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

/**
 * Auth Routes
 */
Auth::routes(['verify' => false]);


Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::middleware('auth')->group(function () {
        /**
         * Home Routes
         */
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        /**
         * Role Routes
         */
        Route::resource('roles', RolesController::class);
        /**
         * Permission Routes
         */
        Route::resource('permissions', PermissionsController::class);
        /**
         * User Routes
         */
        Route::group(['prefix' => 'cms'], function() {
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
                Route::get('/create', 'UsersController@create')->name('users.create');
                Route::post('/create', 'UsersController@store')->name('users.store');
                Route::get('/{user}/show', 'UsersController@show')->name('users.show');
                Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
                Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
                Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
            });
        });
        Route::group(['middleware' => 'auth'], function () {
            Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
//            Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
            Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        });



    });
    Route::group(['prefix' => 'fe'], function() {

    });
});
