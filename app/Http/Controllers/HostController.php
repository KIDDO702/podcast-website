<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Genre;
use App\Models\Episode;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HostController extends Controller
{
    public function index(): View
    {
        $genres = Genre::where('user_id', auth()->user()->id)->count();
        $shows = Show::where('user_id', auth()->user()->id)->count();
        $episodes = Episode::where('user_id', auth()->user()->id)->count();

        $deletedShows = Show::onlyTrashed()->where('user_id', auth()->user()->id)->count();
        $deletedEpisodes = Episode::onlyTrashed()->where('user_id', auth()->user()->id)->count();

        $trash = $deletedShows + $deletedEpisodes;


        return view('host.index', compact('genres', 'shows', 'episodes', 'trash'));
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
