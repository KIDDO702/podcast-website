<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserTable extends Component
{
    public function render()
    {
        $users = User::with('roles')->get();
        return view('livewire.admin.user-table', compact('users'));
    }
}
