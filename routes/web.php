<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VpsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IpController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LocationController;

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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('postlogin', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('cari-vps', [AuthController::class, 'cariVps']);

Route::group(['middleware' => ['auth', 'checkRole:owner,admin,user,noc']], function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('dashboard/{id}/profile', [DashboardController::class, 'profile']);
    Route::post('dashboard/{id}/update', [DashboardController::class, 'update']);
    Route::post('dashboard/{id}/change_password', [DashboardController::class, 'change_password']);
});

Route::group(['middleware' => ['auth', 'checkRole:admin,noc,user']], function () {
    Route::get('profilku', [DashboardController::class, 'profilku']);
});

Route::group(['middleware' => ['auth', 'checkRole:owner,noc']], function () {
    Route::get('vps', [VpsController::class, 'index']);
    Route::get('vps/search', [VpsController::class, 'search'])->name('vps.search');
    Route::post('vps/create', [VpsController::class, 'create']);
    Route::get('vps/{id}/edit', [VpsController::class, 'edit']);
    Route::post('vps/{id}/update', [VpsController::class, 'update']);
    Route::get('vps/{id}/delete', [VpsController::class, 'delete']);
});

Route::group(['middleware' => ['auth', 'checkRole:owner,noc']], function () {
    Route::get('client', [ClientController::class, 'index']);
    Route::get('client/search', [ClientController::class, 'search'])->name('client.search');
    Route::post('client/create', [ClientController::class, 'newClient']);
    Route::get('client/{id}/edit', [ClientController::class, 'editClient']);
    Route::post('client/{id}/update', [ClientController::class, 'updateClient']);
    Route::get('client/{id}/delete', [ClientController::class, 'destroyClient']);
});

Route::group(['middleware' => ['auth', 'checkRole:owner,noc']], function () {
    Route::get('location', [LocationController::class, 'index']);
    Route::get('location/search', [LocationController::class, 'search'])->name('location.search');
    Route::post('location/input', [LocationController::class, 'input']);
    Route::get('location/{id}/hapus', [LocationController::class, 'hapus']);
});

Route::group(['middleware' => ['auth', 'checkRole:owner,noc']], function () {
    Route::get('master_ip', [IpController::class, 'index']);
    Route::get('ip/search', [IpController::class, 'search'])->name('ip.search');
    Route::post('master_ip/create', [IpController::class, 'create']);
    Route::get('master_ip/{id}/delete', [IpController::class, 'destroy']);
});

Route::group(['middleware' => ['auth', 'checkRole:owner,admin']], function () {
    Route::get('admin/cashbond', [KaryawanController::class, 'index']);
    Route::get('admin/cashbond/{id}/konfirmasi', [KaryawanController::class, 'konfirmasi']);
    Route::post('admin/cashbond/{id}/update', [KaryawanController::class, 'update']);
    Route::get('admin/cashbond/{id}/hapus', [KaryawanController::class, 'hapus']);
    Route::post('admin/cashbond/pembayaran', [KaryawanController::class, 'pengajuan']);
    Route::get('admin/data_karyawan', [KaryawanController::class, 'data_karyawan']);
    Route::get('karyawan/{id}/profile', [KaryawanController::class, 'profil_karyawan']);
    Route::get('cashbondByMonth', [KaryawanController::class, 'cashbondByMonth'])->name('cashbondByMonth');
    Route::post('admin/absen', [KaryawanController::class, 'admin_absen']);
});

Route::group(['middleware' => ['auth', 'checkRole:user,noc,admin']], function () {
    Route::get('cashbond', [KaryawanController::class, 'cashbond']);
    Route::post('cashbond/pengajuan', [KaryawanController::class, 'pengajuan']);
    Route::get('cashbond/{id}/cancel', [KaryawanController::class, 'cancel']);
    Route::get('absensi', [KaryawanController::class, 'absensi']);
    Route::post('absen', [KaryawanController::class, 'absen']);
});
