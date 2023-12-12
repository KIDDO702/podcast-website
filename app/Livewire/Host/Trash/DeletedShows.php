<?php

namespace App\Livewire\Host\Trash;

use App\Models\Show;
use Livewire\Component;

class DeletedShows extends Component
{
    public function render()
    {
        $shows = Show::onlyTrashed()
                ->where('user_id', auth()->user()->id)->get();

        return view('livewire.host.trash.deleted-shows', compact('shows'));
    }
}
