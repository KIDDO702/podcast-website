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

    public function genreEdit(string $slug)
    {
        $genre = Genre::where('slug', $slug)->first();
        $userGenres = Auth::user()->genre;

        if (!$genre) {

            toast()
                ->warning('No genre found')
                ->pushOnNextPage();

            return redirect()->back();
        }

        return view('host.genre.edit', compact('genre', 'userGenres'));
    }
}
