<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Master\MenuController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\StatusController;
use App\Http\Controllers\Master\KlinikController;
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
    return view('front.page.home');
});
Route::get('/', [UmumController::class, 'beranda'])->name('home');
Route::get('/tentang-kami', [UmumController::class, 'tentang'])->name('tentangkami');

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
        'prefix' => 'cms-website',
        'as' => 'cms-website.',
    ], function () {
        Route::group([
            'prefix' => 'tentang-kami',
            'as' => 'tentang-kami.',
        ], function () {
            Route::get('/', [WebController::class, 'indextentang'])->name('tentangindex');
            Route::post('/simpan', [WebController::class, 'storetentang'])->name('tentangstore');
        });

        Route::group([
            'prefix' => 'artikel',
            'as' => 'artikel.',
        ], function () {
            Route::group([
                'prefix' => 'galeri',
                'as' => 'galeri.',
            ], function () {
                Route::get('/', [WebController::class, 'indexgaleri'])->name('galeriindex');
                Route::post('/simpan', [WebController::class, 'storegaleri'])->name('tentangstore');
            });
        });
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

            Route::group([
                'prefix' => 'status',
                'as' => 'status.',
            ], function () {
                Route::get('/', [StatusController::class, 'index'])->name('index');
                Route::post('/simpan', [StatusController::class, 'store'])->name('store');
                Route::post('/edit', [StatusController::class, 'edit'])->name('edit');
                Route::post('/ubah', [StatusController::class, 'ubah'])->name('ubah');
                Route::post('/datatable', [StatusController::class, 'datatable'])->name('datatable');
                Route::post('/destroy', [StatusController::class, 'destroy'])->name('destroy');
            });
        });

        Route::group([
            'prefix' => 'klinik',
            'as' => 'klinik.',
        ], function () {
            Route::group([
                'prefix' => 'daftar',
                'as' => 'daftar.',
            ], function () {
                Route::get('/', [KlinikController::class, 'index'])->name('index');
                Route::post('/simpan', [KlinikController::class, 'store'])->name('store');
                Route::post('/edit', [KlinikController::class, 'edit'])->name('edit');
                Route::post('/ubah', [KlinikController::class, 'ubah'])->name('ubah');
                Route::post('/datatable', [KlinikController::class, 'datatable'])->name('datatable');
                Route::post('/destroy', [KlinikController::class, 'destroy'])->name('destroy');
            });

            Route::group([
                'prefix' => 'poli',
                'as' => 'poli.',
            ], function () {
                Route::get('/', [KlinikController::class, 'indexpoli'])->name('poliindex');
                Route::post('/simpan', [KlinikController::class, 'storepoli'])->name('polistore');
                Route::post('/edit', [KlinikController::class, 'editpoli'])->name('poliedit');
                Route::post('/ubah', [KlinikController::class, 'ubahpoli'])->name('poliubah');
                Route::post('/datatable', [KlinikController::class, 'datatablepoli'])->name('polidatatable');
                Route::post('/destroy', [KlinikController::class, 'destroypoli'])->name('polidestroy');
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
