<?php

namespace App\Livewire\Admin;

use App\Models\Episode;
use Livewire\Component;

class EpisodeTable extends Component
{
    public function render()
    {
        $episodes = Episode::all();
        return view('livewire.admin.episode-table', compact('episodes'));
    }
}
