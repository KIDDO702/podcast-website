<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Show;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        $shows = Show::latest()->take(5)->get();
        return view('user.index', compact('shows'));
    }

    public function show(string $slug)
    {
        $show = Show::where('slug', $slug)->first();

        if (!$show) {

            toast()
                ->warning('No show found')
                ->pushOnNextPage();

            return back();
        }

        return view('user.show.index', compact('show'));
    }

    public function litsen(Request $request, string $slug): View
    {
        $show = Show::where('slug', $slug)->first();

        if (!$show)
        {
            toast()
                ->warning('Show cannot be found')
                ->pushOnNextPage();

            return back();
        }

        // Get the selected episode
        $episodeSlug = $request->query('ep');
        $selectedEpisode = Episode::where('slug', $episodeSlug)->first();



        return view('user.show.litsen', compact('show', 'selectedEpisode'));
    }
}
