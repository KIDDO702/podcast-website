<?php

namespace App\Livewire\User\Episode;

use Livewire\Component;

class Reply extends Component
{
    public $reply;

    public function render()
    {
        return view('livewire.user.episode.reply');
    }
}
