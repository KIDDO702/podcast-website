<?php

namespace App\Livewire;

use App\Models\Show;
use Livewire\Component;

class ShowGrid extends Component
{
    public function render()
    {
        $shows = Show::orderBy('title', 'asc')
                       ->where('published', true)
                       ->take(6)
                       ->get();
        return view('livewire.show-grid', compact('shows'));
    }
}
