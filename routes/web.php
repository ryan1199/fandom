<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\FandomCreate;
use App\Livewire\FandomDetails;
use App\Livewire\FandomList;
use App\Livewire\ForgotPassword;
use App\Livewire\Gallery;
use App\Livewire\GalleryShow;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\NewPassword;
use App\Livewire\Post;
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
Route::get('/fandom-list', FandomList::class)->name('fandom-list');
Route::get('/fandom-details/{fandom}', FandomDetails::class)->name('fandom-details');
Route::get('/post-management', Post::class)->middleware('auth')->name('post');
Route::get('/post-show/{post}', PostShow::class)->name('post.show');
Route::get('/gallery-management', Gallery::class)->middleware('auth')->name('gallery');
Route::get('/gallery-show/{gallery}', GalleryShow::class)->name('gallery.show');
// Route::get('test-email-forgot-password', function (Request $request) {
//     return view('forgot-password');
// });
Route::view('test-email-forgot-password', 'forgot-password');
Route::fallback(function () {
    return redirect()->route('home');
});
// jangan ngoper model bindng untuk crud ke komponen lain karena tidak aman (not yet)
// load discusses into the right side navigation bar (done)
// benerin semua wire:key (progress)
// benerin semua format wire:key (progress)
// baru delete discuss
// broadcast ke navigasi (done)
// fandom setting on left side navigation bar (done)
// model binding (user, follow, block, post, gallery, account setting, profile setting, preferences setting, left side navigation bar) (progress)
// create fandom pindah ke navigasi saja (done)
// broadcast fandom created and fandom deleted on fandom list (done only for created)
// broadcast for comment (not yet)
// preferences colors (done)
// broadcast for profile updates (not yet)
// hover in fandom detail (user list, post list and gallery list) (done)
// vote feature (not yet)
// slug for post, image (not yet)
// discusses list style (not yet)
// benerin nama channel (done)
// benerin semua event (done)
// terapkan yang ada di follow (progress)
// pass model binding tidak bisa dengan relationship nya
// home page, comments post show, gallery show and alert component style (not yet)
// post recommendation component by tags and title ? (author, publisher and public post)