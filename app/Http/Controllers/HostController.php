<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HostController extends Controller
{
    public function index(): View
    {
        return view('host.index');
    }

    public function show(): View
    {
        $userShows = Auth::user()->show;
        return view('host.show.index', compact('userShows'));
    }

    public function genre(): View
    {
        $userGenres = Auth::user()->genre;
        return view('host.genre.index', compact('userGenres'));
    }

    public function episode(): View
    {
        $userShows = Auth::user()->show;
        return view('host.episode.index', compact('userShows'));
    }

    
}
