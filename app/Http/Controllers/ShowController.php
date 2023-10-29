<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ShowController extends Controller
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
        return view('admin.show.create', [
            'genres' => Genre::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $show = new Show();
        $genres = $request->input('genres');
        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'description' => 'required',
        ]);

        // Add a show

        $show->user_id = $request->user()->id;
        $show->title = $validated['title'];
        // Slug
        $slug = Str::slug($validated['title']);
        $count = Show::where('slug', $slug)->count();
        // Check if slug exists
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        $show->slug = $slug;
        $show->description = $validated['description'];
        $show->published = $request->has('published');

        if ($request->hasFile('thumbnail')) {
            $show->addMediaFromRequest('thumbnail')->toMediaCollection('show_thumbnail');
        }

        try {

            $show->save();
            $show->genre()->sync($genres);

        } catch (\Throwable $th) {

            throw $th;
        }

        toast()
            ->success('Show Created successfully')
            ->pushOnNextPage();

        return back();




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
    public function edit(string $id)
    {
        $show = Show::find($id);

        if (!$show) {

            toast()
                ->warning('no show found')
                ->pushOnNextPage();

            return back();
        }

        $thumbnail = $show->getFirstMediaUrl('show_thumbnail');
        return view('admin.show.edit', [
            'show' => $show,
            'genres' => Genre::all(),
            'thumbnail' => $thumbnail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $show = Show::find($id);

        if (!$show) {

            toast()
                ->warning('no show found')
                ->pushOnNextPage();

            return back();

        }

        $genres = $request->input('genres');


        $validated = $request->validate([
            'title' => 'required|string|min:5',
            'description' => 'required',
        ]);

        // Update a show

        // $show->user_id = $request->user()->id;
        $show->title = $validated['title'];

        // Slug
        $slug = Str::slug($validated['title']);
        $count = Show::where('slug', $slug)->count();
        // Check if slug exists
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        
        $show->slug = $slug;
        $show->description = $validated['description'];
        $show->published = $request->has('published');

        if ($request->hasFile('thumbnail')) {

            $show->clearMediaCollection('show_thumbnail');
            $show->addMediaFromRequest('thumbnail')->toMediaCollection('show_thumbnail');

        }

        try {

            $show->update();
            $show->genre()->sync($genres);
        } catch (\Throwable $th) {

            throw $th;
        }

        toast()
            ->success('Show Updated successfully')
            ->pushOnNextPage();

        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $show = Show::find($id);

        if (!$show) {

            toast()
                ->warning('no show found')
                ->pushOnNextPage();

            return back();
        }

        $show->delete();

        toast()
            ->success('Show deleted successfully')
            ->pushOnNextPage();

        return back();
    }
}
