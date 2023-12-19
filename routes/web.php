<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\Auth\RegisterUser;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\admin\TrashController;
use App\Http\Controllers\host\HostShowController;
use App\Http\Controllers\host\HostGenreController;
use App\Http\Controllers\host\HostTrashController;
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
        Route::middleware('can:access admin')->prefix('admin')->group( function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware('password.confirm');
            Route::get('/genre', [AdminController::class, 'genre'])->name('admin.genre');
            Route::get('/genre/e/{id}', [GenreController::class, 'edit'])->name('admin.genre.edit');
            Route::put('/genre/e/{id}', [GenreController::class, 'update'])->name('admin.genre.update');
            Route::delete('/genre/d/{id}', [GenreController::class, 'destroy'])->name('admin.genre.delete')->middleware('password.confirm');


            Route::prefix('show')->group( function() {
                Route::get('/', [AdminController::class, 'show'])->name('admin.show');
                Route::get('/create', [ShowController::class, 'create'])->name('admin.show.create')->middleware('can:create show');
                Route::post('/create', [ShowController::class, 'store'])->name('admin.show.store')->middleware('can:create show');
                Route::get('/e/{id}', [ShowController::class, 'edit'])->name('admin.show.edit')->middleware('can:manage show');
                Route::put('e/{id}', [ShowController::class, 'update'])->name('admin.show.update')->middleware('can:manage show');
                Route::delete('d/{id}', [ShowController::class, 'destroy'])->name('admin.show.destroy')->middleware('can:delete show');
            });

            Route::prefix('episode')->group( function () {
                Route::get('/', [AdminController::class, 'episode'])->name('admin.episode');
                Route::get('/create', [EpisodeController::class, 'create'])->name('admin.episode.create')->middleware('can:create episode');
                Route::post('/create', [EpisodeController::class, 'store'])->name('admin.episode.store')->middleware('can:create episode');
                Route::get('e/{id}', [EpisodeController::class, 'edit'])->name('admin.episode.edit')->middleware('can:manage episode');
                Route::put('e/{id}', [EpisodeController::class, 'update'])->name('admin.episode.update')->middleware('can:manage episode');
                Route::delete('d/{id}', [EpisodeController::class, 'destroy'])->name('admin.episode.destroy')->middleware('can:delete episode');

                Route::get('c/{id}', [EpisodeController::class, 'commentView'])->name('admin.episode.comment-view')->middleware('can:manage comment');
                Route::put('c/{id}', [EpisodeController::class, 'commentEdit'])->name('admin.episode.coment-edit')->middleware('can:manage comment');
                Route::delete('c/{id}', [EpisodeController::class, 'commentDelete'])->name('admin.episode.comment-delete')->middleware('can:manage comment');
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
                Route::get('/', [AdminController::class, 'permission'])->name('admin.permission')->middleware('can:manage permission');
                Route::get('e/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
                Route::put('e/{id}', [PermissionController::class, 'update'])->name('admin.permission.update');
                Route::delete('d/{id}', [PermissionController::class, 'destroy'])->name('admin.permission.delete');
            });

            Route::prefix('users')->group( function() {
                Route::get('/', [AdminController::class, 'user'])->name('admin.user');
                Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
                Route::post('/create', [UserController::class, 'store'])->name('admin.user.store');
                Route::get('e/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
                Route::post('e/{id}/assign-role', [UserController::class, 'assignRole'])->name('admin.user.assign-role')->middleware('can:assign role');
                Route::delete('d/{id}/revoke-role', [UserController::class, 'revokeRole'])->name('admin.user.revoke-role')->middleware('can:revoke permission');
                Route::post('e/{id}/assign-permission', [UserController::class, 'assignPermission'])->name('admin.user.assign-permission')->middleware('can:assign role');
                Route::delete('d/{id}/revoke-permission', [UserController::class, 'revokePermission'])->name('admin.user.revoke-permission')->middleware('can:revoke permission');
            });

            Route::prefix('trash')->group( function () {
                Route::get('/', [TrashController::class, 'index'])->name('admin.trash')->middleware('can:access trash');
            });
        });
    });

    // Host Routes
    Route::middleware('role:host')->group(function () {
        Route::middleware('can:access host')->prefix('host')->group( function() {
            Route::get('/', [HostController::class, 'index'])->name('host.index')->middleware('password.confirm');

            Route::middleware('can:create genre')->prefix('genre')->group( function () {
                Route::get('/', [HostController::class, 'genre'])->name('host.genre');
                Route::get('/e/{slug}', [HostGenreController::class, 'edit'])->name('host.genre.edit')->middleware('can:create genre');
                Route::put('e/{slug}', [HostGenreController::class, 'update'])->name('host.genre.update')->middleware('can:create genre');
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
                Route::get('{show}/create', [HostEpisodeController::class, 'create'])->name('host.episode.create')->middleware('can:create episode');
                Route::post('{show}/create', [HostEpisodeController::class, 'store'])->name('host.episode.store')->middleware('can:create episode');
                Route::get('e/{show}/{episode}', [HostEpisodeController::class, 'edit'])->name('host.episode.edit');
                Route::put('e/{show}/{id}', [HostEpisodeController::class, 'update'])->name('host.episode.update');
                Route::delete('d/{id}', [HostEpisodeController::class, 'destroy'])->name('host.episode.delete');

                Route::get('/{comment}', [HostEpisodeController::class, 'commentView'])->name('host.episode.comment-view');
            });

            Route::prefix('trash')->group( function() {
                Route::get('/', [HostTrashController::class, 'index'])->name('host.trash');
                Route::post('/restore-show/{id}', [HostTrashController::class, 'restoreShow'])->name('host.restore-show');
                Route::post('/restore-episode/{id}', [HostTrashController::class, 'restoreEpisode'])->name('host.restore-episode');
                Route::post('/delete-show/{id}', [HostTrashController::class, 'deleteShow'])->name('host.delete-show');
                Route::post('/delete-episode/{id}', [HostTrashController::class, 'deleteEpisode'])->name('host.delete-episode');
            });
        });
    });

    // Password Confrimation
    Route::get('/confirm-password', [AuthenticatedSession::class, 'passwordView'])->name('password.confirm');
    Route::post('/confirm-password', [AuthenticatedSession::class, 'confirmPassword'])->name('confirmed');

    // Upload Route
    Route::post('/tmp-upload', [FileUploadController::class, 'proccess'])->name('filepond.proccess');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/{id}', [UserController::class, 'update'])->name('user.update');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shows', [HomeController::class, 'shows'])->name('shows');
Route::get('/{show}/', [HomeController::class, 'show'])->name('show');
Route::get('litsen/{show}', [HomeController::class, 'litsen'])->name('show.litsen');
Route::get('g/{genre}', [HomeController::class, 'genre'])->name('user.genre');
