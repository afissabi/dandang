<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Master\MenuController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UserController;
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
    Route::get('/kamarhaji', [MenuController::class, 'kamarhaji'])->name('kamarhaji');
    Route::group([
        'prefix' => 'master',
        'as' => 'master.',
    ], function () {

        Route::group([
            'prefix' => 'hak-akses',
            'as' => 'hak-akses.',
        ], function () {
            Route::group([
                'prefix' => 'user',
                'as' => 'user.',
            ], function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/menu-user/{id}', [UserController::class, 'menu_user'])->name('menuUser');
                Route::post('/simpan', [UserController::class, 'store'])->name('store');
                Route::post('/edit', [UserController::class, 'edit'])->name('edit');
                Route::post('/ubah', [UserController::class, 'ubah'])->name('ubah');
                Route::post('/datatable', [UserController::class, 'datatable'])->name('datatable');
                Route::post('/destroy', [UserController::class, 'destroy'])->name('destroy');
            });

            Route::group([
                'prefix' => 'role-user',
                'as' => 'role-user.',
            ], function () {
                Route::get('/', [RoleController::class, 'index'])->name('index');
                Route::post('/simpan', [RoleController::class, 'store'])->name('store');
                Route::post('/edit', [RoleController::class, 'edit'])->name('edit');
                Route::post('/ubah', [RoleController::class, 'ubah'])->name('ubah');
                Route::post('/datatable', [RoleController::class, 'datatable'])->name('datatable');
                Route::post('/destroy', [RoleController::class, 'destroy'])->name('destroy');
                Route::get('/menu/{id}', [RoleController::class, 'menu'])->name('menu');
                Route::post('/simpan-menu', [RoleController::class, 'storeMenu'])->name('storeMenu');
            });

            Route::group([
                'prefix' => 'menu',
                'as' => 'menu.',
            ], function () {
                Route::get('/', [MenuController::class, 'index'])->name('index');
                Route::post('/simpan', [MenuController::class, 'store'])->name('store');
                Route::post('/edit', [MenuController::class, 'edit'])->name('edit');
                Route::post('/ubah', [MenuController::class, 'ubah'])->name('ubah');
                Route::post('/datatable', [MenuController::class, 'datatable'])->name('datatable');
                Route::post('/destroy', [MenuController::class, 'destroy'])->name('destroy');
            });
        });

        Route::group([
            'prefix' => 'pegawai',
            'as' => 'pegawai.',
        ], function () {
            Route::group([
                'prefix' => 'jabatan',
                'as' => 'jabatan.',
            ], function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
            });
        });
    });
});
