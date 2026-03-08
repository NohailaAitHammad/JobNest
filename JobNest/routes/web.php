<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CondidatController;
use App\Http\Controllers\RecruterController;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register/signUpCondidat', [AuthController::class, 'showSignUpCondidiat'])->name('register.condidat');
Route::get('register/signUpRecruter', [AuthController::class, 'showSignUpRecruter'])->name('register.recruter');
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('register/signUpCondidat',[AuthController::class, 'registerCondidat'])->name('store.condidat');
Route::post('register/signUpRecruter',[AuthController::class, 'registerRrecruter'])->name('store.recruter');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::middleware(['auth'])->group(function (){
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(EnsureUserHasRole::class.':recruter')->group(function (){
        Route::get('/recruters/dashboardRecruter',[RecruterController::class, 'index'])->name('recruter.dashboard');
    });
    Route::middleware(EnsureUserHasRole::class.':condidat')->group(function (){
        Route::get('/condidat/dashboardCondidat', [CondidatController::class, 'index'])->name('condidat.dashboard');
    });
    Route::middleware(EnsureUserHasRole::class.':admin')->group(function (){
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

});


