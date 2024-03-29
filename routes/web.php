<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\ForgotPassword;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\NewPassword;
use App\Livewire\Register;
use App\Livewire\User;
use App\Livewire\Verification;
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

Route::get('/', Home::class)->name('home');
Route::get('/login', Login::class)->middleware(['throttle:login','no_auth'])->name('login');
Route::get('/register', Register::class)->middleware(['throttle:register','no_auth'])->name('register');
Route::get('/forgot-password', ForgotPassword::class)->middleware(['throttle:forgot-password','no_auth'])->name('forgot-password');
Route::get('/new-password/{ticket}', NewPassword::class)->middleware(['throttle:new-password','no_auth','valid_ticket'])->name('new-password');
Route::get('/verification', Verification::class)->middleware(['throttle:verification','no_auth'])->name('verification.send');
Route::get('/verification/{ticket}', Verification::class)->middleware(['throttle:verification','no_auth','valid_ticket'])->name('verification.verify');
Route::post('/logout', [LogoutController::class, 'process'])->middleware(['throttle:logout','auth'])->name('logout');
Route::get('/user/{user}', User::class)->middleware('auth')->name('user');
Route::view('/test', 'home')->name('test');
Route::fallback(function () {
    return redirect()->route('home');
});