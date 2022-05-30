<?php

use App\Barang;
use App\Jenis;
use App\Satuan;
use App\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/create', function () {
    $data  = Barang::where('id', 4)->pluck('jumlah');
    $dt = $data[0] - 300;
    dd($dt);


});
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// ROUTE ADMIN
Route::group(['middleware' => ['auth','Admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard','DashboardController@DashboardAdmin' )->name('admin');

    // KELOLA USER
    route::get('/index/user','UserController@index')->name('admin.user');
    route::post('/tambah/user','UserController@tambahUser')->name('admin.tambahuser');
    route::get('/edit/user/{id}','UserController@editUser')->name('admin.edituser');
    route::post('/update/user/{id}','UserController@updateUser')->name('admin.updateuser');
    route::get('/hapus/user/{id}','UserController@hapusUser')->name('admin.hapususer');

    // KELOLA SATUAN
    route::get('/index/satuan','SatuanController@index')->name('admin.satuan');
    route::post('/tambah/satuan','SatuanController@tambahSatuan')->name('admin.tambahsatuan');
    route::get('/edit/satuan/{id}','SatuanController@editSatuan')->name('admin.editsatuan');
    route::post('/update/satuan/{id}','SatuanController@updateSatuan')->name('admin.updatesatuan');
    route::get('/hapus/satuan/{id}','SatuanController@hapusSatuan')->name('admin.hapussatuan');

    // KELOLA JENIS
    route::get('/index/jenis','JenisController@index')->name('admin.jenis');
    route::post('/tambah/jenis','JenisController@tambahJenis')->name('admin.tambahjenis');
    route::get('/edit/jenis/{id}','JenisController@editJenis')->name('admin.editjenis');
    route::post('/update/jenis/{id}','JenisController@updateJenis')->name('admin.updatejenis');
    route::get('/hapus/jenis/{id}','JenisController@hapusJenis')->name('admin.hapusjenis');

    // KELOLA BARANG
    route::get('/index/barang','BarangController@index')->name('admin.barang');
    route::post('/tambah/barang','BarangController@tambahBarang')->name('admin.tambahbarang');
    route::get('/edit/barang/{id}','BarangController@editBarang')->name('admin.editbarang');
    route::post('/update/barang/{id}','BarangController@updateBarang')->name('admin.updatebarang');
    route::get('/hapus/barang/{id}','BarangController@hapusBarang')->name('admin.hapusbarang');

    // KELOLA SUPPLIER
    route::get('/index/supplier','supplierController@index')->name('admin.supplier');
    route::post('/tambah/supplier','supplierController@tambahSupplier')->name('admin.tambahsupplier');
    route::get('/edit/supplier/{id}','supplierController@editSupplier')->name('admin.editsupplier');
    route::post('/update/supplier/{id}','supplierController@updateSupplier')->name('admin.updatesupplier');
    route::get('/hapus/supplier/{id}','supplierController@hapusSupplier')->name('admin.hapussupplier');

    // KELOLA BARANG MASUK
    route::get('/index/masuk','BarangMasukController@index')->name('admin.masuk');
    route::get('/getdatabarang/{id}','BarangMasukController@getProp')->name('admin.getprop');
    route::post('/tambah/masuk','BarangMasukController@tambahbarang')->name('admin.tambahbarangmasuk');
    route::get('/hapus/masuk/{id}','BarangMasukController@hapusBarang')->name('admin.masukhapus');

    // KELOLA BARANG MASUK
    route::get('/index/keluar','BarangKeluarController@index')->name('admin.keluar');
    route::get('/getdatabarang/{id}','BarangKeluarController@getProp')->name('admin.getproperti');
    route::post('/tambah/keluar','BarangKeluarController@tambahbarang')->name('admin.tambahbarangkeluar');
    route::get('/hapus/keluar/{id}','BarangKeluarController@hapusBarang')->name('admin.keluarhapus');

    // KELOLA LAPORAN

    // --SUPPLIER
    route::get('/index/laporansupplier','LaporanController@viewlaporansupplier')->name('admin.laporansupplier');
    route::get('/index/export/laporansupplier','LaporanController@downloadlaporansupplier')->name('admin.expsupplier');

    // --BARANG
    route::get('/index/laporanbarang','LaporanController@viewlaporanbarang')->name('admin.laporanbarang');
    route::get('/index/export/laporanbarang','LaporanController@downloadlaporanbarang')->name('admin.expbarang');

    // --BARANG MASUK
    route::get('/index/laporanbarangmasuk','LaporanController@viewlaporanbarangmasuk')->name('admin.laporanbarangmasuk');
    route::get('/index/export/laporanbarangmasuk','LaporanController@downloadlaporanbarangmasuk')->name('admin.expbarangmasuk');
    route::get('/cobacetak','LaporanController@cobacetak')->name('admin.cobacetak');

    // --BARANG KELUAR
    route::get('/index/laporanbarangkeluar','LaporanController@viewlaporanbarangkeluar')->name('admin.laporanbarangkeluar');
    route::get('/index/export/laporanbarangkeluar','LaporanController@downloadlaporanbarangkeluar')->name('admin.expbarangkeluar');
});

// ROUTE PETUGAS
Route::group(['middleware' => ['auth','Petugas'], 'prefix' => 'petugas'], function () {
    Route::get('/dashboard','DashboardController@DashboardPetugas' )->name('petugas');
});
