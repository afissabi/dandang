<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

Route::get('/login', function () {
    return view('back.login');
});

Route::get('/sign-out', [LoginController::class, 'logout'])->name('keluar');
Route::post('/login-user', [LoginController::class, 'login'])->name('masuk');

Route::group(['middleware' => 'user'], function () {
    Route::get('/home', function () {
        return view('back.welcome.welcome');
    }); 
});
