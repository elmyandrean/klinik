<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;

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

Route::middleware('auth')->group(function(){
  Route::GET('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resource('patients', PatientController::class);
  Route::POST('/logout_action', [AuthController::class, 'logout_action'])->name('logout_action');
});

Route::middleware('guest')->group(function(){
  Route::GET('/', function(){
    return view('auth.login_starter');
  })->name('login_starter');
  Route::GET('/login', [AuthController::class, 'login'])->name('login');
  Route::POST('/login_action', [AuthController::class, 'login_action'])->name('login_action');
});
