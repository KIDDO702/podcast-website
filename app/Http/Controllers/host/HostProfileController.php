<?php

namespace App\Http\Controllers\host;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HostProfileController extends Controller
{
    public function index()
    {
        return view('host.profile.index');
    }
}
