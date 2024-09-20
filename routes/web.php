<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();



Route::get('admindashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admins');
Route::get('adminlogin', [App\Http\Controllers\AdminController::class, 'adminloginpage'])->name('admin.loginpage');
Route::post('adminchecklogin', [App\Http\Controllers\AdminController::class, 'adminlogin'])->name('admin.login');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix("drive")->group(function(){
// to show private data
Route::get('index',[App\Http\Controllers\DrivesController::class, 'index'])->name('drive.index');
// to show bublic data and private data all data
Route::get('allDrives',[App\Http\Controllers\DrivesController::class, 'allDrives'])->name('drive.allDrives')->middleware('roleone');
// to show bublic data
Route::get('public',[App\Http\Controllers\DrivesController::class, 'public'])->name('drive.public');

//to change status
Route::get('status/{id}',[App\Http\Controllers\DrivesController::class, 'status'])->name('drive.status');
// to create file
Route::get('create',[App\Http\Controllers\DrivesController::class, 'create'])->name('drive.create');
// to store data
Route::post('store',[App\Http\Controllers\DrivesController::class, 'store'])->name('drive.store');
// to edit data
Route::get('edit/{id}',[App\Http\Controllers\DrivesController::class, 'edit'])->name('drive.edit');
// to show data
Route::get('show/{id}',[App\Http\Controllers\DrivesController::class, 'show'])->name('drive.show');
// to update data
Route::post('update/{id}',[App\Http\Controllers\DrivesController::class, 'update'])->name('drive.update');
// to delete data
Route::get('destroy/{id}',[App\Http\Controllers\DrivesController::class, 'destroy'])->name('drive.destroy');
// to download data
Route::get('download/{id}',[App\Http\Controllers\DrivesController::class, 'download'])->name('drive.download');
// to show users
Route::get('user',[App\Http\Controllers\Auth\usercontroller::class, 'user'])->name('auth.user')->middleware('roleone');
// error page
Route::get('error',[App\Http\Controllers\Homecontroller::class, 'error'])->name('view.404');

});
