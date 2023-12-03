<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function comment(Request $request, string $slug)
    {
        $validated = $request->validate([
            'body' => 'required'
        ]);

        $episode = Episode::where('slug', $slug)->first();

        dd($validated, $episode);
    }
}
