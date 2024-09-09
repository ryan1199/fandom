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
Route::get('/fandom-details/{fandom}', FandomDetails::class)->name('fandom-details');
Route::get('/post-management', PostManagement::class)->middleware('auth')->name('post-management');
Route::get('/post-show/{post:slug}', PostShow::class)->name('post.show');
Route::get('/post', Post::class)->name('post');
Route::get('/gallery-management', GalleryManagement::class)->middleware('auth')->name('gallery-management');
Route::get('/gallery-show/{gallery:slug}', GalleryShow::class)->name('gallery.show');
Route::get('/gallery', Gallery::class)->name('gallery');
Route::view('test-email-forgot-password', 'forgot-password');
Route::fallback(function () {
    return redirect()->route('home');
});
// jangan ngoper model bindng untuk crud ke komponen lain karena tidak aman (done)
// load discusses into the right side navigation bar (done)
// benerin semua wire:key (done)
// benerin semua format wire:key (done)
// broadcast ke navigasi (done)
// fandom setting on left side navigation bar (done)
// model binding (user, follow, block, post, gallery, account setting, profile setting, preferences setting, left side navigation bar) (done)
// create fandom pindah ke navigasi saja (done)
// broadcast fandom created and fandom deleted on fandom list (done only for created)
// broadcast for comment (done)
// preferences colors (done)
// broadcast for profile updates (done)
// hover in fandom detail (user list, post list and gallery list) (done)
// slug for post, gallery (done)
// discusses list style (done)
// benerin nama channel (done)
// benerin semua event (done)
// terapkan yang ada di follow (progress)
// pass model binding tidak bisa dengan relationship nya
// home page, comments, post show, gallery show and alert component style (done)
// user component style (done)
// post create edit component style (done)
// gallery create edit component style (done)
// chat component style (done)
// post recommendation component by tags and title ? (author, publisher and public post) (done)
// broadcast fandom created to (fandom list) (done)
// broadcast for updated fandom to (fandom details and fandom list) (done)
// post and post management components (done)
// gallery and gallery management components (done)
// format alpine data (done)
// broadcast joined or leaved fandoms members (done)
// component for join or leave fandom button (done)
// component for fandom member list (done)
// component for fandom profile (done)
// broadcast for post published, and unpublished (fandom details, user page) (done)
// broadcast for gallery published, and unpublished (fandom details, user page) (done)
// user profile image storage (done)
// broadcast for updated fandom (user page) (done)
// broadcast for joined fandom (user page) (done)
// user friendlist (done)
// fandom gallery delete broadcast error (done)
// post management (post list, post card) (done)
// post (post list, post card) (done)
// gallery management (gallery list, gallery card) (done)
// gallery (gallery list, gallery card) (done)
// navigasi pindahkan (done)
// vote feature (done)
// fix home component (done)
// fix post show and gallery show (done)
// update user page layout (not yet)