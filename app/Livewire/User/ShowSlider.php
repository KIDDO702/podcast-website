<?php

namespace App\Livewire\User;

use App\Models\Show;
use Livewire\Component;

class ShowSlider extends Component
{
    public function render()
    {
        $shows = Show::where('published', true)
                      ->latest()
                      ->take(5)
                      ->get();


        return view('livewire.user.show-slider', compact('shows'));
    }
}
