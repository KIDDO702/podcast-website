<?php

namespace App\Livewire\User\Episode;

use Livewire\Component;

class Comment extends Component
{
    public $episode;

    public function render()
    {
        return view('livewire.user.episode.comment');
    }
}
