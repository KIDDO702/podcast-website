<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\Auth\RegisterUser;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\host\HostShowController;
use App\Http\Controllers\host\HostGenreController;
use App\Http\Controllers\Auth\AuthenticatedSession;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\host\HostEpisodeController;

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


// Protected Routes
Route::middleware('auth')->group( function() {

    // Admin Routes
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

            Route::prefix('roles')->group( function() {
                Route::get('/', [AdminController::class, 'role'])->name('admin.role');
                Route::get('e/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
                Route::put('e/{id}', [RoleController::class, 'update'])->name('admin.role.update');
                Route::post('e/{role}/permissions', [RoleController::class, 'givePermission'])->name('admin.role.permission');
                Route::delete('d/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('admin.role.permission.revoke');
                Route::delete('d/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');
            });

            Route::prefix('permissions')->group( function () {
                Route::get('/', [AdminController::class, 'permission'])->name('admin.permission');
                Route::get('e/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
                Route::put('e/{id}', [PermissionController::class, 'update'])->name('admin.permission.update');
                Route::delete('d/{id}', [PermissionController::class, 'destroy'])->name('admin.permission.delete');
            });

            Route::prefix('users')->group( function() {
                Route::get('/', [AdminController::class, 'user'])->name('admin.user');
                Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
                Route::post('/create', [UserController::class, 'store'])->name('admin.user.store');
                Route::get('e/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
                Route::post('e/{id}/assign-role', [UserController::class, 'assignRole'])->name('admin.user.assign-role');
                Route::delete('d/{id}/revoke-role', [UserController::class, 'revokeRole'])->name('admin.user.revoke-role');
                Route::post('e/{id}/assign-permission', [UserController::class, 'assignPermission'])->name('admin.user.assign-permission');
                Route::delete('d/{id}/revoke-permission', [UserController::class, 'revokePermission'])->name('admin.user.revoke-permission');
            });
        });
    });

    // Host Routes
    Route::middleware('role:host')->group(function () {
        Route::prefix('host')->group( function() {
            Route::get('/', [HostController::class, 'index'])->name('host.index')->middleware('password.confirm');

            Route::middleware('can:create genre')->prefix('genre')->group( function () {
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
                Route::get('{show}/create', [HostEpisodeController::class, 'create'])->name('host.episode.create');
                Route::post('{show}/create', [HostEpisodeController::class, 'store'])->name('host.episode.store');
                Route::get('e/{show}/{episode}', [HostEpisodeController::class, 'edit'])->name('host.episode.edit');
                Route::put('e/{show}/{id}', [HostEpisodeController::class, 'update'])->name('host.episode.update');
                Route::delete('d/{id}', [HostEpisodeController::class, 'destroy'])->name('host.episode.delete');
            });
        });
    });

    // Password Confrimation
    Route::get('/confirm-password', [AuthenticatedSession::class, 'passwordView'])->name('password.confirm');
    Route::post('/confirm-password', [AuthenticatedSession::class, 'confirmPassword'])->name('confirmed');

    // Upload Route
    Route::post('/tmp-upload', [FileUploadController::class, 'proccess'])->name('filepond.proccess');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{show}/', [HomeController::class, 'show'])->name('show');
Route::get('litsen/{show}', [HomeController::class, 'litsen'])->name('show.litsen');
