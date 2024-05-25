<?php

use App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\HubkaryawanController;
use App\Http\Controllers\Backend\KaryawanController;
use App\Http\Controllers\Backend\MasterAreaController;
use App\Http\Controllers\Backend\MasterOutletController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\MasterSkuController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return ['Laravel' => app()->version()];
// });
// route web backend
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [Backend::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [Backend::class, 'profile'])->name('profile.edit');
});

Route::get('/', [Backend::class, 'signin'])->name('signin');
Route::get('/register', [Backend::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('karyawan', KaryawanController::class); //karyawan
    Route::resource('hubkaryawan', HubkaryawanController::class); //hubkaryawan
    Route::resource('sku', MasterSkuController::class); //sku
    Route::resource('area', MasterAreaController::class); //area
    Route::resource('outlet', MasterOutletController::class); //outlet
    Route::resource('user', UserController::class); //user

    Route::resource('event', EventController::class); //event
});
// routes/web.php
Route::get('/karyawan/{id}/nama', [App\Http\Controllers\Backend\KaryawanController::class, 'getNama'])->name('karyawan.getNama');


require __DIR__ . '/auth.php';
