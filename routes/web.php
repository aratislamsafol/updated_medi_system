<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout',[HomeController::class,'logout'])->name('logout');
// ============================= Division ======================================
Route::get('division_datatable', [DivisionController::class,'index'])->name('division.all');
Route::post('store-division', [DivisionController::class,'store']);
Route::post('edit-division', [DivisionController::class,'edit']);
Route::post('delete-division', [DivisionController::class,'destroy']);
Route::get('view-division',  [DivisionController::class,'view']);

// ============================= Distric ======================================
Route::get('district_datatable', [DistrictController::class,'index']);
Route::post('store-distric', [DistrictController::class,'store']);
Route::post('edit-distric', [DistrictController::class,'edit']);
Route::post('delete-district', [DistrictController::class,'destroy']);
Route::get('view-distric', [DistrictController::class,'view']);

// API routes
Route::get('get-districts/{id}', function($id){
    return json_encode(App\Models\District::where('division_id', $id)->get());
});
Route::get('admin/dash',[DashboardController::class,'index'])->name('admin.dashboard');

//==============================Patient==========================================
Route::resource('patients', PatientController::class);
Route::post('delete/patient', [PatientController::class,'destroy'])->name('patients.destroy');
