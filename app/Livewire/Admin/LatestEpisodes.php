<?php

namespace App\Livewire\Admin;

use App\Models\Episode;
use Livewire\Component;

class LatestEpisodes extends Component
{
    public function render()
    {
        $episodes = Episode::orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.admin.latest-episodes', compact('episodes'));
    }
}
