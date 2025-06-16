<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::Class, 'authenticate'])->name('login.auth');

Route::get('/dashboard', [DashboardController::class, 'index' ])->name('dashboard');

// route customer
Route::get('/master/customer', [CustomerController::class, 'index'])->name('master.customer');
Route::post('/master/customer/create', [CustomerController::class, 'store'])->name('master.customer.store');

// route services
Route::get('/master/service', [ServiceController::class, 'index'])->name('master.service');
Route::post('/master/service/create', [ServiceController::class, 'store'])->name('master.service.store');