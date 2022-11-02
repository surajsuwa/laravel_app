<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
})->name('apanel');

//dashboard
Route::group(['prefix' => 'apanel', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('index');
    })->name('apanel');

    //logout
    Route::get('logout',[AuthUserController::class,'logout'])->name('logout.logout');

});


//login
Route::get('/',[AuthUserController::class,'create'])->name('login.create');
Route::post('authenticate',[AuthUserController::class,'authenticate'])->name('login.authenticate');

//register
Route::get('register',[RegisteredUserController::class,'create'])->name('register.create');
Route::post('register',[RegisteredUserController::class,'store'])->name('register.store');



//blog
Route::resource('blogs', BlogController::class);
