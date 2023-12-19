<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{

    use WithPagination;

    public $pagination = 5;

    public function updatePerPage($newPerPage)
    {
        $this->pagination = $newPerPage;
    }

    public function render()
    {
        $users = User::with('roles')->orderBy('name', 'asc')->paginate($this->pagination);
        return view('livewire.admin.user-table', compact('users'));
    }
}
