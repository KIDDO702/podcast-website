<?php

namespace App\Livewire\Admin;

use App\Models\Show;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTable extends Component
{
    use WithPagination;

    public $pagination = 5;

    public function updatePerPage($newPerPage)
    {
        $this->pagination = $newPerPage;
    }

    public function render()
    {
        $shows = Show::orderBy('created_at', 'desc')->paginate($this->pagination);
        return view('livewire.admin.show-table', compact('shows'));
    }
}
