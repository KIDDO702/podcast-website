<?php

namespace App\Livewire\Host\Trash;

use App\Models\Episode;
use Livewire\Component;

class DeletedEpisodes extends Component
{
    public function render()
    {
        $episodes = Episode::onlyTrashed()
            ->where('user_id', auth()->user()->id)->get();


        return view('livewire.host.trash.deleted-episodes', compact('episodes'));
    }
}
