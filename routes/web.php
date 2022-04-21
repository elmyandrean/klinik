<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PhotoController;

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
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resource('patients', PatientController::class);
  Route::get('treatments/comparison', [TreatmentController::class, 'comparison'])->name('treatments.comparison');
  Route::get('treatments/get_photos', [TreatmentController::class, 'get_photos'])->name('treatments.get_photos');
  Route::resource('treatments', TreatmentController::class);
  Route::post('/logout_action', [AuthController::class, 'logout_action'])->name('logout_action');
  Route::post('/photos/upload_images', [PhotoController::class, 'upload_images'])->name('photos.upload_images');
  Route::get('/photos/get_photo_no_threatment', [PhotoController::class, 'get_photo_no_threatment'])->name('photos.get_photo_no_threatment');
  Route::delete('/photos/delete_image', [PhotoController::class, 'delete_image'])->name('photos.delete_image');
});

Route::middleware('guest')->group(function(){
  Route::get('/', function(){
    return view('auth.login_starter');
  })->name('login_starter');
  Route::get('/login', [AuthController::class, 'login'])->name('login');
  Route::post('/login_action', [AuthController::class, 'login_action'])->name('login_action');
});
