<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GenreController extends Controller
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
        $validated = $request->validate([
            'name' => 'required|min:5|string|unique:genres,name'
        ]);

        try {

            Genre::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name'])
            ]);

        } catch (\Throwable $th) {

            throw $th;

        }
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
    public function edit(String $id): View
    {
        $genre = Genre::find($id);

        // dd($genre);

        if (!$genre) {

            toast()
                ->warning('No genre found')
                ->pushOnNextPage();

            return redirect(route('admin.genre'));
        }

        return view('admin.genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $genre = Genre::find($id);

        if (!$genre) {

            toast()
                ->warning('No genre found')
                ->pushOnNextPage();

            return redirect(route('admin.genre'));
        }

        $validated = $request->validate([
            'name' => 'required|min:5|string|unique:genres,name'
        ]);

        $genre->name = $validated['name'];
        $genre->slug = Str::slug($validated['name']);

        $genre->update();

        toast()
            ->success('Genre Updated Successfully')
            ->pushOnNextPage();

        return redirect(route('admin.genre'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $genre = Genre::find($id);

        if (!$genre) {

            toast()
                ->warning('No genre found')
                ->pushOnNextPage();

            return redirect(route('admin.genre'));
        }

        $genre->delete();

        toast()
            ->success('Genre deleted successfully')
            ->pushOnNextPage();

        return redirect(route('admin.genre'));
    }
}
