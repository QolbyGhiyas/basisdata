<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\Produk;
use App\Http\Controllers\Penjualan;

Route::get('/', function() {
    return view('index');
});

// Pelanggan
Route::get('/input-pelanggan', function() {
    return view ('pelanggan');
});

Route::post('/input/proses', [Pelanggan::class, 'proses_data_pelanggan'])->name('insert');

Route::get('/datapelanggan', [Pelanggan::class, 'lihat_data_pelanggan'])->name('read');

Route::get('/datapelanggan/{id}', [Pelanggan::class, 'form_edit_pelanggan'])->name('form_edit_pelanggan');

Route::post('/datapelanggan/edit/{id}', [Pelanggan::class, 'update_data_pelanggan'])->name('update_pelanggan');

Route::get('/datapelanggan/delete/{id}', [Pelanggan::class, 'delete_data_pelanggan'])->name('delete_pelanggan');
// Pelanggan end
// Produk
Route::get('/input-produk', function() {
    return view ('produk');
});

Route::post('/input/proses/produk', [Produk::class, 'proses_data_produk'])->name('insert.produk');

Route::get('/dataproduk', [Produk::class, 'lihat_data_produk'])->name('read.produk');

Route::get('/dataproduk/{id}', [Produk::class, 'form_edit_produk'])->name('form_edit_produk');

Route::post('/dataproduk/edit/{id}', [Produk::class, 'update_data_produk'])->name('update_produk');

Route::get('/dataproduk/delete/{id}', [Produk::class, 'delete_data_produk'])->name('delete_produk');
//Produk end
//Penjualan
Route::get('/input-penjualan', [Penjualan::class, 'form_penjualan'])->name('form_penjualan');

Route::post('/input/proses/penjualan', [Penjualan::class, 'proses_data_penjualan'])->name('insert.penjualan');

Route::get('/datapenjualan', [Penjualan::class, 'lihat_data_penjualan'])->name('lihat_penjualan');

Route::get('/datapenjualan/{id}', [Penjualan::class, 'form_edit_penjualan'])->name('form_edit_penjualan');

Route::post('/datapenjualan/edit/{id}', [Penjualan::class, 'update_data_penjualan'])->name('update_penjualan');

Route::get('/datapenjualan/delete/{id}', [Penjualan::class, 'delete_data_penjualan'])->name('delete_penjualan');
//Penjualan end