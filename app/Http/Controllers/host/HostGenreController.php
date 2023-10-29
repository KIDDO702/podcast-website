<?php

namespace App\Http\Controllers\host;

use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HostGenreController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $genre = Genre::where('slug', $slug)->first();

        if (!$genre) {

            toast()
                ->warning('No genre found')
                ->pushOnNextPage();

            return redirect(route('host.genre.edit'));
        }

        $validated = $request->validate([
            'name' => 'required|min:3|string|unique:genres,name'
        ]);

        $genre->name = $validated['name'];
        $genre->slug = Str::slug($validated['name']);
        $genre->user_id = $request->user()->id;

        $genre->update();

        toast()
            ->success('Genre Updated Successfully')
            ->pushOnNextPage();

        return redirect(route('host.genre'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
