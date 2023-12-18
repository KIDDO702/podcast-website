<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\User;
use App\Models\Genre;
use App\Models\Episode;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $genres = Genre::all();
        $shows = Show::all();
        $episodes = Episode::all();
        $users = User::all();
        $hosts = User::role('host')->count();
        $admins = User::role('admin')->count();

        return view('admin.index', compact('genres', 'shows', 'episodes', 'users', 'hosts', 'admins'));
    }

    public function genre(): View
    {
        return view('admin.genre.index');
    }

    public function show(): View
    {
        return view('admin.show.index');
    }

    public function episode(): View
    {
        return view('admin.episode.index');
    }

    public function role(): View
    {
        return view('admin.role.index');
    }

    public function permission(): View
    {
        return view('admin.permission.index');
    }

    public function user(): View
    {
        return view('admin.user.index');
    }
}
