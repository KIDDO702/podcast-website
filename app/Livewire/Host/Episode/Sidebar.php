<?php

namespace App\Livewire\Host\Episode;

use Livewire\Component;

class Sidebar extends Component
{
    public $shows;
    public $showId;

    public function mount($shows)
    {
        $this->shows = $shows;
    }

    public function selectShow($showId)
    {
        // $this->showId = $showId;
        $this->dispatch('showSelected', $showId);
    }

    public function render()
    {
        return view('livewire.host.episode.sidebar');
    }
}
