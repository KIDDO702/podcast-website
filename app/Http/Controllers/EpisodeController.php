<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Comment;
use App\Models\Episode;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EpisodeController extends Controller
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
    public function create(): View
    {
        $shows = Show::all();
        return view('admin.episode.create', compact('shows'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $episode = new Episode();

        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'show' => 'required',
            'description' => 'required',
            'youtube_link' => 'nullable',
            'spotify_link' => 'nullable',
        ]);

        $episode->user_id = $request->user()->id;
        $episode->show_id = $validated['show'];
        $episode->title = $validated['title'];
        $episode->description = $validated['description'];
        $episode->youtube_link = $validated['youtube_link'];
        $episode->spotify_link = $validated['spotify_link'];

        // Slug
        $slug = Str::slug($validated['title']);
        $count = Episode::where('slug', $slug)->count();
        // Check if slug exists
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $episode->slug = $slug;

        // Media
        if ($request->hasFile('thumbnail')) {
            $episode->addMediaFromRequest('thumbnail')->toMediaCollection('episode_thumbnail');
        }

        if ($request->has('audio')) {
            $episode->addMediaFromRequest('audio')->toMediaCollection('audio');
        }

        $episode->published = $request->has('published');

        $episode->save();

        toast()
            ->success('Episode created successfully')
            ->pushOnNextPage();

        return back();
    }

    /**
     * Display the episode comment resource.
     */
    public function commentView(Request $request, string $id)
    {
        $episode = Episode::find($id)->first();

        $commentId = $request->query('comment');
        $comment = Comment::find($commentId)->first();

        return view('admin.comment.edit', compact('episode', 'comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $episode = Episode::find($id);
        $shows = Show::all();
        $audioFile = $episode->getFirstMedia('audio');

        if (!$episode) {

            toast()
                ->warning('No episode found')
                ->pushOnNextPage();

            return back();
        }

        return view('admin.episode.edit', compact('episode', 'shows', 'audioFile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $episode = Episode::find($id);

        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'show' => 'required',
            'description' => 'required',
            'youtube_link' => 'nullable',
            'spotify_link' => 'nullable',
        ]);

        $episode->user_id = $request->user()->id;
        $episode->show_id = $validated['show'];
        $episode->title = $validated['title'];
        $episode->description = $validated['description'];
        $episode->youtube_link = $validated['youtube_link'];
        $episode->spotify_link = $validated['spotify_link'];

        // Slug
        $slug = Str::slug($validated['title']);
        $count = Episode::where('slug', $slug)
            ->where('id', '!=', $episode->id)
            ->count();

        // Check if slug exists
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        $episode->slug = $slug;
        $episode->published = $request->has('published');

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

        return redirect(route('admin.episode.update', $episode->id));
    }

    public function commentEdit(Request $request, string $id)
    {
        $commentId = $request->query('comment');
        $comment = Comment::find($commentId)->first();

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $comment->body = $validated['body'];
        $comment->approved = $request->has('approved');

        $comment->update();

        toast()
            ->success('comment updated successfully')
            ->pushOnNextPage();

        return back();
    }

    public function commentDelete(string $id)
    {
        $comment = Comment::find($id)->first();

        if (!$comment) {

            toast()
                ->warning('No comment found!')
                ->pushOnNextPage();

            return back();
        }

        $comment->delete();

        toast()
            ->success('Comment deleted successfully')
            ->pushOnNextPage();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $episode = Episode::find($id);

        if (!$episode) {

            toast()
                ->warning('No episode found')
                ->pushOnNextPage();

            return back();
        }

        $episode->delete();

        toast()
            ->success('Episode deleted successfully')
            ->pushOnNextPage();

        return back();
    }
}
