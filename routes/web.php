<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Master\MenuController;
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
    Route::get('/dashboard', function () {
        return view('back.welcome.welcome');
    });

    Route::group([
        'prefix' => 'master',
        'as' => 'master.',
    ], function () {
        
        Route::group([
            'prefix' => 'menu',
            'as' => 'menu.',
        ], function () {
            Route::get('/', [MenuController::class, 'index'])->name('index');
            Route::post('/simpan', [MenuController::class, 'store'])->name('store');
            Route::post('/datatable', [MenuController::class, 'datatable'])->name('datatable');
            Route::post('/destroy', [MenuController::class, 'destroy'])->name('destroy');
        });

        Route::group([
            'prefix' => 'role-user',
            'as' => 'role-user.',
        ], function () {
            Route::get('/', [MenuController::class, 'role'])->name('role');
        });
    });
});
