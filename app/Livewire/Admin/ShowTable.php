<?php

namespace App\Livewire\Admin;

use App\Models\Show;
use Livewire\Component;

class ShowTable extends Component
{
    public function render()
    {
        $shows = Show::all();
        return view('livewire.admin.show-table', compact('shows'));
    }
}
