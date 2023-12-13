<?php

namespace App\Livewire\Admin;

use App\Models\Show;
use Livewire\Component;

class LatestShows extends Component
{
    public function render()
    {
        $shows = Show::orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.admin.latest-shows', compact('shows'));
    }
}
