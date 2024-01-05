<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'home')->name('home');
Route::get('/login', [LoginController::class, 'view'])->name('login.view');
Route::post('/login', [LoginController::class, 'process'])->name('login');
Route::get('/register', [RegisterController::class, 'view'])->name('register.view');
Route::post('/register', [RegisterController::class, 'process'])->name('register');
Route::get('/reset-password', [ResetPasswordController::class, 'view'])->name('reset-password.view');
Route::post('/reset-password', [ResetPasswordController::class, 'sendEmailResetPassword'])->name('reset-password.send');
Route::get('/new-password/{ticket}', [ResetPasswordController::class, 'newPassword'])->middleware('valid_ticket')->name('reset-password.new');
Route::post('/new-password/{ticket}', [ResetPasswordController::class, 'updatePassword'])->middleware('valid_ticket')->name('reset-password.update');
Route::get('/verification', [VerificationController::class, 'view'])->name('verification.view');
Route::post('/verification', [VerificationController::class, 'sendEmailVerification'])->name('verification.send');
Route::get('/verification/{ticket}', [VerificationController::class, 'verifyEmail'])->middleware('valid_ticket')->name('verification.verify');
Route::post('/logout', [LogoutController::class, 'process'])->name('logout');