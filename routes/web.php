<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DaftarBookingController;
use App\Http\Controllers\PengelolaController;
use App\Models\Pengelola;

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


Route::prefix('/admin')->namespace('App\Http\Controllers')->group(function(){
    Route::match(['post', 'get'], 'login', 'LoginController@Login');
    Route::get('index', 'AdminController@index');
    Route::get('logout', 'AdminController@Logout');
    Route::get('tambah', 'AdminController@create')->name('indextambah');
    Route::post('Pengelola/index', 'AdminController@createpengelola')->name('tambahpengelola');
    Route::get('/Pengelola/hapus/{id}', 'AdminController@destroy')->name('hapuspengelola');
    Route::post('/Pengelola/update/{id}', 'AdminController@update')->name('updatepengelola');
    Route::get('tambahLokasi', 'LokasiController@index')->name('indexlokasi');
    Route::get('/Lokasi/hapus/{id}', 'LokasiController@destroy')->name('hapuslokasi');
    Route::post('Lokasi/index', 'LokasiController@store')->name('tambahlokasi');
    Route::post('/Lokasi/update/{id}', 'LokasiController@update')->name('updatelokasi');
    Route::get('member', 'MemberController@index');
    Route::get('lapangan', 'LapanganController@index')->name('indexlapangan');
    Route::post('Lapangan/index', 'LapanganController@store')->name('tambahlapangan');
    Route::get('/Lapangan/hapus/{id}', 'LapanganController@destroy')->name('hapuslapangan');
    Route::post('/Lapangan/update/{id}', 'LapanganController@update')->name('updatelapangan');
});


Route::get('/booking', [BookingController::class, 'index']);

Route::get('/daftarbooking', [DaftarBookingController::class, 'index'])->name('daftarbookindex');
Route::post('/daftarbooking/{id}', [DaftarBookingController::class, 'update'])->name('editbooking');


Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');



Route::prefix('/pengelola')->namespace('App\Http\Controllers')->group(function(){
    Route::match(['post', 'get'],'login', [PengelolaController::class, 'login']);
    Route::get('index', 'PengelolaController@index');
    Route::get('logout', 'PengelolaController@Logout');
    Route::get('/booking', [PengelolaController::class, 'booking']);
    Route::post('/booking/terima/{id}', [PengelolaController::class, 'terimabooking'])->name('terimabooking');
    Route::post('/booking/tolak/{id}', [PengelolaController::class, 'tolakbooking'])->name('tolakbooking');
});

