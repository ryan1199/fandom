<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Fandom;
use App\Livewire\FandomDetails;
use App\Livewire\ForgotPassword;
use App\Livewire\Gallery;
use App\Livewire\GalleryManagement;
use App\Livewire\GalleryShow;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\NewPassword;
use App\Livewire\Post;
use App\Livewire\PostManagement;
use App\Livewire\PostShow;
use App\Livewire\Register;
use App\Livewire\User;
use App\Livewire\Verification;
use Illuminate\Http\Request;
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
Route::get('/login', Login::class)->middleware(['throttle:login', 'no_auth'])->name('login');
Route::get('/register', Register::class)->middleware(['throttle:register', 'no_auth'])->name('register');
Route::get('/forgot-password', ForgotPassword::class)->middleware(['throttle:forgot-password', 'no_auth'])->name('forgot-password');
Route::get('/new-password/{ticket}', NewPassword::class)->middleware(['throttle:new-password', 'no_auth', 'valid_ticket'])->name('new-password');
Route::get('/verification', Verification::class)->middleware(['throttle:verification', 'no_auth'])->name('verification.send');
Route::get('/verification/{ticket}', Verification::class)->middleware(['throttle:verification', 'no_auth', 'valid_ticket'])->name('verification.verify');
Route::post('/logout', LogoutController::class)->middleware(['throttle:logout', 'auth'])->name('logout');
Route::get('/user/{user}', User::class)->middleware('auth')->name('user');
Route::get('/fandom-list', Fandom::class)->name('fandom-list');
Route::get('/fandom-details/{fandom}', FandomDetails::class)->middleware('user_not_banned')->name('fandom-details');
Route::get('/post-management', PostManagement::class)->middleware('auth')->name('post-management');
Route::get('/post-show/{post:slug}', PostShow::class)->middleware('user_not_banned')->name('post.show');
Route::get('/post', Post::class)->name('post');
Route::get('/gallery-management', GalleryManagement::class)->middleware('auth')->name('gallery-management');
Route::get('/gallery-show/{gallery:slug}', GalleryShow::class)->middleware('user_not_banned')->name('gallery.show');
Route::get('/gallery', Gallery::class)->name('gallery');
Route::fallback(function () {
    return redirect()->route('home');
});