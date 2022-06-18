<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CardController;

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

Route::group(['middleware' => ['auth', 'verified', 'XssSanitizer']], function() {
    Route::get('/events',[EventController::class, 'index'])->name('events.index');
    Route::post('/events',[EventController::class, 'store'])->name('events.store');
    Route::get('/events/create',[EventController::class, 'create'])->name('events.create');
    Route::get('/events/{event}/edit',[EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}',[EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{uuid}', [EventController::class, 'destroy'])->name('events.destroy');

    //only admin root
    Route::group(['middleware' => ['role:admin']], function () {
        //
    });

    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/about', function () {
    return view('dashboard');
})->name('about');

Route::middleware(['auth', 'verified'])->get('/two-factor-auth', function () {
    return view('auth.two-factor-auth');
})->name('two-factor-auth');

Route::get('/events/{uuid}',[EventController::class, 'show'])->name('events.show');
Route::post('/events/join',[EventController::class, 'join'])->name('events.join');
