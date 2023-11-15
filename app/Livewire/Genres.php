<?php

namespace App\Livewire;

use App\Models\Genre;
use Livewire\Component;

class Genres extends Component
{
    public function render()
    {
        $genres = Genre::orderBy('name', 'asc')->get();
        return view('livewire.genres', compact('genres'));
    }
}
