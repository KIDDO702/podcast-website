<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HostController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\Auth\RegisterUser;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\host\HostGenreController;
use App\Http\Controllers\Auth\AuthenticatedSession;
use App\Http\Controllers\host\HostShowController;

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


// Authentification Routes
Route::get('/login', [AuthenticatedSession::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSession::class, 'login'])->name('auth.login');
Route::get('/register', [RegisterUser::class, 'create'])->name('register');
Route::post('/register', [RegisterUser::class, 'store'])->name('auth.register');
Route::post('/logout', [AuthenticatedSession::class, 'logout'])->name('logout');


// Home
Route::get('/', function () {
    return view('home');
})->name('home');


// Protected Routes
Route::middleware('auth')->group( function() {

    Route::middleware('role:admin')->group( function () {
        Route::prefix('admin')->group( function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware('password.confirm');
            Route::get('/genre', [AdminController::class, 'genre'])->name('admin.genre');
            Route::get('/genre/e/{id}', [GenreController::class, 'edit'])->name('admin.genre.edit');
            Route::put('/genre/e/{id}', [GenreController::class, 'update'])->name('admin.genre.update');
            Route::delete('/genre/d/{id}', [GenreController::class, 'destroy'])->name('admin.genre.delete')->middleware('password.confirm');


            Route::prefix('show')->group( function() {
                Route::get('/', [AdminController::class, 'show'])->name('admin.show');
                Route::get('/create', [ShowController::class, 'create'])->name('admin.show.create');
                Route::post('/create', [ShowController::class, 'store'])->name('admin.show.store');
                Route::get('/e/{id}', [ShowController::class, 'edit'])->name('admin.show.edit');
                Route::put('e/{id}', [ShowController::class, 'update'])->name('admin.show.update');
                Route::delete('d/{id}', [ShowController::class, 'destroy'])->name('admin.show.destroy');
            });

            Route::prefix('episode')->group( function () {
                Route::get('/', [AdminController::class, 'episode'])->name('admin.episode');
                Route::get('/create', [EpisodeController::class, 'create'])->name('admin.episode.create');
                Route::post('/create', [EpisodeController::class, 'store'])->name('admin.episode.store');
                Route::get('e/{id}', [EpisodeController::class, 'edit'])->name('admin.episode.edit');
            });
        });
    });

    Route::middleware('role:host')->group(function () {
        Route::prefix('host')->group( function() {
            Route::get('/', [HostController::class, 'index'])->name('host.index')->middleware('password.confirm');

            Route::prefix('genre')->group( function () {
                Route::get('/', [HostController::class, 'genre'])->name('host.genre');
                Route::get('/e/{slug}', [HostGenreController::class, 'edit'])->name('host.genre.edit');
                Route::put('e/{slug}', [HostGenreController::class, 'update'])->name('host.genre.update');
                Route::delete('/d/{id}', [GenreController::class, 'destroy'])->name('host.genre.delete')->middleware('password.confirm');
            });

            Route::prefix('show')->group( function() {
                Route::get('/', [HostController::class, 'show'])->name('host.show');
                Route::get('/create', [HostShowController::class, 'create'])->name('host.show.create');
                Route::post('/create', [HostShowController::class, 'store'])->name('host.show.store');
                Route::get('e/{slug}', [HostShowController::class, 'edit'])->name('host.show.edit');
                Route::put('e/{id}', [HostShowController::class, 'update'])->name('host.show.update');
                Route::delete('d/{id}', [HostShowController::class, 'destroy'])->name('host.show.delete')->middleware('password.confirm');
            });

            Route::prefix('episode')->group( function () {
                Route::get('/', [HostController::class, 'episode'])->name('host.episode');
            });
        });
    });


    Route::get('/confirm-password', [AuthenticatedSession::class, 'passwordView'])->name('password.confirm');
    Route::post('/confirm-password', [AuthenticatedSession::class, 'confirmPassword'])->name('confirmed');
});
