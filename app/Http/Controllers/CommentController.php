<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Livewire\WithFileUploads;

class CommentController extends Controller
{

    public function comment(Request $request, String $slug)
    {
        $episode = Episode::where('slug', $slug)->first();
        dd($episode, $request->input('comment'));
    }
}
