<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
//-------------------authentication--------------------------
});
Route::get('/register', [UserController::class, 'register_page'])->name('users.register_page');
Route::get('/login', [UserController::class, 'login_page'])->name('users.login_page');

Route::post('/register_post', [UserController::class, 'register_post'])->name('users.register');
Route::post('/login_post', [UserController::class, 'login_post'])->name('users.login');
//------------------------albums ----------------------------
Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::resource('albums', AlbumController::class);

});
