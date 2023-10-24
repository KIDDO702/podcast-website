<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }

    public function genre(): View
    {
        return view('admin.genre.index');
    }

    public function show(): View
    {
        return view('admin.show.index');
    }
}
