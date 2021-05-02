<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPeminjamanController;
use App\Http\Controllers\Admin\AdminPengembalianController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\JenisController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\ReportInController;
use App\Http\Controllers\Admin\ReportOutController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController as UserUserController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Route::get('/login',[AuthController::class,'loginForm'])->name('loginForm');
Route::get('/register',[AuthController::class,'registerForm'])->name('registerForm');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Auth::routes();


Route::prefix('admin')->name('admin.')->group(function(){
    Route::prefix('dashboard')->name('dashboard.')->group(function(){
        Route::get('', [AdminController::class, 'index'])->name('index');
    });
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('show/{id}', [UserController::class, 'show'])->name('show');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::put('update', [UserController::class, 'update'])->name('update');
        Route::post('store', [UserController::class, 'store'])->name('store');
    });
    Route::prefix('alat')->name('alat.')->group(function(){
        Route::get('', [AlatController::class, 'index'])->name('index');
        Route::get('index-alat/{jenisId}', [AlatController::class, 'indexAlat'])->name('indexAlat');
        Route::get('show/{id}', [AlatController::class, 'show'])->name('show');
        Route::get('create/{jenisId}', [AlatController::class, 'create'])->name('create');
        Route::get('edit/{id}', [AlatController::class, 'edit'])->name('edit');
        Route::delete('delete/{id}', [AlatController::class, 'delete'])->name('delete');
        Route::put('update', [AlatController::class, 'update'])->name('update');
        Route::post('store', [AlatController::class, 'store'])->name('store');
        Route::post('pinjam', [AlatController::class, 'pinjam'])->name('pinjam');
    });
    Route::prefix('jenis')->name('jenis.')->group(function(){
        Route::get('', [JenisController::class, 'index'])->name('index');
        Route::get('show/{id}', [JenisController::class, 'show'])->name('show');
        Route::get('create', [JenisController::class, 'create'])->name('create');
        Route::get('edit/{id}', [JenisController::class, 'edit'])->name('edit');
        Route::delete('delete/{id}', [JenisController::class, 'delete'])->name('delete');
        Route::put('update', [JenisController::class, 'update'])->name('update');
        Route::post('store', [JenisController::class, 'store'])->name('store');
    });
    Route::prefix('transaksi')->name('transaksi.')->group(function(){
        Route::get('', [AdminPeminjamanController::class, 'index'])->name('index');
        Route::get('', [AdminPeminjamanController::class, 'index'])->name('index');
    });
    
    Route::prefix('peminjaman')->name('peminjaman.')->group(function(){
        Route::get('', [AdminPeminjamanController::class, 'index'])->name('index');
        Route::get('show/{id}', [AdminPeminjamanController::class, 'show'])->name('show');
        Route::get('delete/{id}', [AdminPeminjamanController::class, 'delete'])->name('delete');
        Route::post('konfirmasi', [AdminPeminjamanController::class, 'konfirmasi'])->name('konfirmasi');
    });
    Route::prefix('pengembalian')->name('pengembalian.')->group(function(){
        Route::get('', [AdminPengembalianController::class, 'index'])->name('index');
        Route::post('konfirmasi', [AdminPengembalianController::class, 'konfirmasi'])->name('konfirmasi');
    });
    Route::prefix('laporan')->name('laporan.')->group(function(){
        Route::get('pdf', [AdminPengembalianController::class, 'pdf'])->name('pdf');
    });

});

Route::prefix('user')->name('user.')->group(function(){
    Route::prefix('dashboard')->name('dashboard.')->group(function(){
        Route::get('', [UserUserController::class,'index'])->name('index');
    });
    Route::prefix('peminjaman')->name('peminjaman.')->group(function(){
        Route::get('', [PeminjamanController::class, 'index'])->name('index');
        Route::get('show/{id}', [PeminjamanController::class, 'show'])->name('show');
        Route::get('delete/{id}', [PeminjamanController::class, 'delete'])->name('delete');
        Route::post('create', [PeminjamanController::class, 'create'])->name('create');
        Route::post('pdf', [PeminjamanController::class, 'pdf'])->name('pdf');
    });
    Route::prefix('pengembalian')->name('pengembalian.')->group(function(){
        Route::get('', [PengembalianController::class, 'index'])->name('index');
        Route::post('', [PengembalianController::class, 'store'])->name('store');
    });
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

