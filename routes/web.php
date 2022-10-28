<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReviewProdukController;
use App\Http\Controllers\RiwayatProdukController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherUserController;
use App\Http\Controllers\WishlistController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('user', UserController::class)->except('show', 'create', 'edit');
    // Route::resource('kategori', KategoriController::class)->except('show');
    Route::resource('sub_kategori', SubKategoriController::class)->except('show');
    Route::resource('produk', ProdukController::class);
    Route::resource('keranjang', KeranjangController::class)->except('show');
    Route::resource('wishlist', WishlistController::class)->except('show');
    Route::resource('review_produk', ReviewProdukController::class)->except('edit');
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('history', HistoryController::class);
    Route::resource('voucher', VoucherController::class);
    Route::resource('voucher_user', VoucherUserController::class);
    Route::resource('riwayat_produk', RiwayatProdukController::class)->except('show', 'edit');
    Route::resource('top_up', TopUpController::class)->except('show', 'edit');
});
