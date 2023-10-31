<?php

namespace App\Livewire\Host\Episode;

use App\Models\Show;
use Livewire\Component;

class ShowEpisodes extends Component
{
    public $shows;
    public $selectedShow = null;

    public function mount($shows)
    {
        $this->shows = $shows;
    }

    public function selectShow($showId)
    {
        $this->selectedShow = Show::find($showId);

        // dd($this->selectedShow);
    }

    public function render()
    {
        return view('livewire.host.episode.show-episodes');
    }
}
