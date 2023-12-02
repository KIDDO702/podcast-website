<?php

namespace App\Livewire\User\Episode;

use App\Models\Episode;
use Livewire\Component;
use Illuminate\Http\Request;
use Usernotnull\Toast\Concerns\WireToast;

class Comment extends Component
{
    public $episode;

    
    public function render()
    {
        return view('livewire.user.episode.comment');
    }
}
