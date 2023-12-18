<?php

namespace App\Livewire;

use App\Models\Genre;
use Livewire\Component;

class Genres extends Component
{
    public $perPage = 10;

    public function render()
    {
        $genres = Genre::latest()->paginate($this->perPage);

        return view('livewire.genres', compact('genres'));
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
}
