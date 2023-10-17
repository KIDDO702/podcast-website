<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUser;
use App\Http\Controllers\Auth\AuthenticatedSession;

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
        Route::get('/admin', function () {
            return 'admin route';
        });
    });

    Route::middleware('role:host')->group(function () {
        Route::get('/host', function () {
            return 'host route';
        });
    });


});
