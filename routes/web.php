<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUser;
use App\Http\Controllers\Auth\AuthenticatedSession;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ShowController;

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
            });
        });
    });

    Route::middleware('role:host')->group(function () {
        Route::get('/host', function () {
            return 'host route';
        })->middleware('password.confirm');
    });


    Route::get('/confirm-password', [AuthenticatedSession::class, 'passwordView'])->name('password.confirm');
    Route::post('/confirm-password', [AuthenticatedSession::class, 'confirmPassword'])->name('confirmed');
});
