<?php

namespace App\Http\Controllers\host;

use App\Models\Show;
use App\Models\Episode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HostEpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $slug)
    {
        $show = Show::where('slug', $slug)->first();

        if (!$show) {

            toast()
                ->warning('No show found!')
                ->pushOnNextPage();

            return back();
        }

        return view('host.episode.create', compact('show'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $slug)
    {
        // Show
        $show = Show::where('slug', $slug)->first();

        if(!$show)
        {
            toast()
                ->warning('Please select a show')
                ->pushOnNextPage();

            return back();
        }

        // Validation
        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'description' => 'nullable',
            'thumbnail' => 'required|mimes:png,jpg,jpeg|max:2048|file|image',
            'audio' => 'required|file|mimes:mp3',
            'youtube_link' => 'nullable',
            'spotify_link' => 'nullable'
        ]);

        // Slug
        $slug = Str::slug($validated['title']);
        $count = Episode::where('slug', $slug)->count();
        if ($count > 0) {
            // Append a number to make the slug unique
            $slug = $slug . '-' . ($count + 1);
        }

        $episode = new Episode([
            'title' => $validated['title'],
            'slug' => $slug,
            'description' => $validated['description'],
            'published' => $request->has('published'),
            'youtube_link' => $validated['youtube_link'],
            'spotify_link' => $validated['spotify_link']
        ]);

        $episode->show_id = $show->id;
        $episode->user_id = $request->user()->id;

        // Audio and Thumbnail
        $episode->addMediaFromRequest('thumbnail')
        ->toMediaCollection('episode_thumbnail');
        $episode->addMediaFromRequest('audio')
        ->toMediaCollection('audio');

        try {
            $save = $episode->save();
        } catch (\Throwable $th) {
            throw $th;
        }

        if (!$save) {

            toast()
                ->warning('something happened please try again!')
                ->pushOnNextPage();
            return back();

        } else {

            toast()
                ->success('Episode created successfully')
                ->pushOnNextPage();

            return back();
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $showSlug, string $episodeSlug): View
    {
        $show = Show::where('slug', $showSlug)->first();
        $episode = Episode::where('slug', $episodeSlug)->first();

        return view('host.episode.edit', compact('show', 'episode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $showSlug, string $id)
    {
        $show = Show::where('slug', $showSlug)->first();
        $episode = Episode::find($id);

        if (!$show) {
            toast()
                ->warning('Please select a show')
                ->pushOnNextPage();

            return back();
        }

        // Validation
        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'description' => 'nullable',
            'thumbnail' => 'mimes:png,jpg,jpeg|max:2048|file|image',
            'audio' => 'file|mimes:mp3',
        ]);

        $episode->title = $validated['title'];

        // Slug
        $slug = Str::slug($validated['title']);
        $count = Episode::where('slug', $slug)->count();
        if ($count > 0) {
            // Append a number to make the slug unique
            $slug = $slug . '-' . ($count + 1);
        }

        $episode->slug = $slug;
        $episode->description = $validated['description'];
        $episode->published = $request->has('published');
        $episode->show_id = $show->id;

        // Update the thumbnail and audio
        if ($request->hasFile('thumbnail')) {
            $episode->clearMediaCollection('episode_thumbnail');
            $episode->addMediaFromRequest('thumbnail')
            ->toMediaCollection('episode_thumbnail');
        }

        if ($request->hasFile('audio')) {
            $episode->clearMediaCollection('audio');
            $episode->addMediaFromRequest('audio')
                ->toMediaCollection('audio');
        }

        $episode->update();

        toast()
            ->success($episode->title . ' ' . 'updated successfully')
            ->pushOnNextPage();

        return redirect(route('host.episode'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $episode = Episode::find($id);

        if(!$episode)
        {
            toast()
                ->warning('No episode selected')
                ->pushOnNextPage();

            return back();
        }

        $episode->delete();

        toast()
            ->success('episode deleted successfully')
            ->pushOnNextPage();

        return redirect(route('host.episode'));
    }
}
