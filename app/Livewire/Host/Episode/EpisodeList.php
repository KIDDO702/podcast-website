<?php

namespace App\Livewire\Host\Episode;

use App\Models\Show;
use App\Models\Episode;
use Livewire\Component;

class EpisodeList extends Component
{
    public $showId;
    public $episodes;

    protected $listeners = ['loadEpisodes'];

    public function loadEpisodes($showId)
    {
        $this->showId = $showId;
        // $this->episodes = Episode::where('show_id', $showId)->get();
        $show = Show::find($showId);

        dd($show);
        // $this->episodes = $show->episode;

    }

    public function render()
    {
        return view('livewire.host.episode.episode-list');
    }
}
