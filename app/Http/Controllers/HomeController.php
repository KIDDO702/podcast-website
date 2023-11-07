<?php

namespace App\Http\Controllers;

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
}
