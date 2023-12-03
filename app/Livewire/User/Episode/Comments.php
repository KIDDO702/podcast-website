<?php

namespace App\Livewire\User\Episode;

use Livewire\Component;

class Comments extends Component
{
    public $comments;

    public function render()
    {
        return view('livewire.user.episode.comments');
    }
}
