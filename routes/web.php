<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\GalonController;
use App\Http\Controllers\HargaJenisController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    session()->flush();
    Artisan::call('optimize');
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('clear-compiled');
    return 'done';
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('user/data', [UserController::class, 'data'])->name('user.data');
    Route::resource('user', UserController::class);

    Route::get('karyawan/data', [KaryawanController::class, 'data'])->name('karyawan.data');
    Route::resource('karyawan', KaryawanController::class);

    Route::get('supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
    Route::resource('supplier', SupplierController::class);

    Route::get('produk/data', [ProdukController::class, 'data'])->name('produk.data');
    Route::get('produk/{id}/produk_by_kode', [ProdukController::class, 'produk_by_kode'])->name('produk.produk_by_kode');
    Route::resource('produk', ProdukController::class);

    Route::get('retur/data', [ReturController::class, 'data'])->name('retur.data');
    Route::resource('retur', ReturController::class);

    Route::get('hargajenis/data', [HargaJenisController::class, 'data'])->name('hargajenis.data');
    Route::get('hargajenis/get_harga', [HargaJenisController::class, 'get_harga'])->name('hargajenis.get_harga');
    Route::resource('hargajenis', HargaJenisController::class);

    Route::get('konsumen/data', [KonsumenController::class, 'data'])->name('konsumen.data');
    Route::resource('konsumen', KonsumenController::class);

    Route::get('pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
    Route::resource('pengeluaran', PengeluaranController::class);

    Route::get('galon/data', [GalonController::class, 'data'])->name('galon.data');
    Route::get('galon/{id}/get_by_pejualan', [GalonController::class, 'get_by_pejualan'])->name('galon.get_by_pejualan');
    Route::resource('galon', GalonController::class);

    Route::get('jabatan/data', [JabatanController::class, 'data'])->name('jabatan.data');
    Route::resource('jabatan', JabatanController::class);

    Route::get('pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
    Route::get('pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::get('pembelian/{id}/detail', [PembelianController::class, 'detail'])->name('pembelian.detail');
    Route::resource('pembelian', PembelianController::class)
        ->except('create', 'edit');

    Route::get('pembeliandetail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembeliandetail.data');
    Route::get('pembeliandetail/{id}/total_detail', [PembelianDetailController::class, 'total_detail'])->name('pembeliandetail.total_detail');
    Route::resource('pembeliandetail', PembelianDetailController::class);

    Route::get('penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
    Route::get('penjualan/{id}/create', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::get('penjualan/{id}/penjualan_by_pelanggan', [PenjualanController::class, 'penjualan_by_pelanggan'])->name('penjualan.penjualan_by_pelanggan');
    Route::resource('penjualan', PenjualanController::class)
        ->except('create');

    Route::get('penjualandetail/{id}/data', [PenjualanDetailController::class, 'data'])->name('penjualandetail.data');
    Route::get('penjualandetail/{id}/total_detail', [PenjualanDetailController::class, 'total_detail'])->name('penjualandetail.total_detail');
    Route::resource('penjualandetail', PenjualanDetailController::class);

    Route::get('pembayaran/data', [PembayaranController::class, 'data'])->name('pembayaran.data');
    Route::resource('pembayaran', PembayaranController::class);

    Route::get('provinces', [DependantDropdownController::class, 'provinces'])->name('provinces');
    Route::get('cities', [DependantDropdownController::class, 'cities'])->name('get_kota');
    Route::get('districts', [DependantDropdownController::class, 'districts'])->name('get_kecamatan');
    Route::get('villages', [DependantDropdownController::class, 'villages'])->name('get_kelurahan');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('dashboard/get_penjualan', [DashboardController::class, 'get_penjualan'])->name('dashboard.get_penjualan');
    Route::get('dashboard/laporan_bulanan', [DashboardController::class, 'laporan_bulanan'])->name('dashboard.laporan_bulanan');
});
