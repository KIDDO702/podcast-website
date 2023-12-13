<?php

namespace App\Livewire\Host;

use App\Models\Episode;
use Livewire\Component;

class LatestEpisodes extends Component
{
    public function render()
    {
        $episodes = Episode::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('livewire.host.latest-episodes', compact('episodes'));
    }
}
