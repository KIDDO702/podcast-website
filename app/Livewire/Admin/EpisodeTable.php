<?php

namespace App\Livewire\Admin;

use App\Models\Episode;
use Livewire\Component;

class EpisodeTable extends Component
{
    public $pagination = 5;

    public function updatePerPage($newPerPage)
    {
        $this->pagination = $newPerPage;
    }

    public function render()
    {
        $episodes = Episode::orderBy('title', 'asc')->paginate($this->pagination);
        return view('livewire.admin.episode-table', compact('episodes'));
    }
}
