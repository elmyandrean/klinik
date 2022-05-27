<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiagnosesController;
use App\Http\Controllers\ExportPhotoController;
use App\Http\Controllers\ImportPhotoController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TreatmentController;

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
  Route::get('patients/treatments/comparison', [TreatmentController::class, 'comparison'])->name('treatments.comparison');
  Route::get('patients/treatments/get_photos', [TreatmentController::class, 'get_photos'])->name('treatments.get_photos');
  Route::get('patients/treatments/get_by_date', [TreatmentController::class, 'get_by_date'])->name('treatments.get_by_date');
  Route::resource('patients/treatments', TreatmentController::class);
  Route::post('/logout_action', [AuthController::class, 'logout_action'])->name('logout_action');

  Route::get('patients/photos/get_photo_no_threatment', [PhotoController::class, 'get_photo_no_threatment'])->name('photos.get_photo_no_threatment');
  Route::post('patients/photos/upload_images', [PhotoController::class, 'upload_images'])->name('photos.upload_images');
  Route::post('patients/photos/update_images', [PhotoController::class, 'update_image'])->name('photos.update_image');
  Route::delete('patients/photos/delete_image', [PhotoController::class, 'delete_image'])->name('photos.delete_image');
  Route::get('patients/photos/{id}', [PhotoController::class, 'get_photo'])->name('photos.get_photo');
  
  Route::get('patients/export/photo', [ExportPhotoController::class, 'index'])->name('exports.index');
  Route::post('patients/export/photo/clear', [ExportPhotoController::class, 'clear'])->name('exports.clear');
  Route::post('patients/export/photo/download', [ExportPhotoController::class, 'download'])->name('exports.download');
  Route::post('patients/export/photo/{id}', [ExportPhotoController::class, 'add'])->name('exports.add');
  Route::delete('patients/export/photo/{id}', [ExportPhotoController::class, 'delete'])->name('exports.delete');

  Route::post('patients/import/data', [ImportPhotoController::class, 'store_data'])->name('imports.data');
  Route::post('patients/import/photo', [ImportPhotoController::class, 'store_photo'])->name('imports.photo');
  
  Route::get('patient/import', [PatientController::class, 'import'])->name('patients.import');
  Route::get('patients/export', [PatientController::class, 'export'])->name('patients.export');
  Route::resource('patients', PatientController::class);
  Route::resource('actions', ActionController::class);
  Route::resource('diagnoses', DiagnosesController::class);
});

Route::middleware('guest')->group(function(){
  Route::get('/', function(){
    return view('auth.login_starter');
  })->name('login_starter');
  Route::get('/login', [AuthController::class, 'login'])->name('login');
  Route::post('/login_action', [AuthController::class, 'login_action'])->name('login_action');
});
