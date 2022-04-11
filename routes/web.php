<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
  Route::GET('dashboard', function(){
    return view('dashboard.index');
  })->name('dashboard');
});

Route::GET('/login', [AuthController::class, 'login'])->name('login');
Route::POST('/login_action', [AuthController::class, 'login_action'])->name('login_action');
Route::POST('/logout_action', [AuthController::class, 'logout_action'])->name('logout_action');
