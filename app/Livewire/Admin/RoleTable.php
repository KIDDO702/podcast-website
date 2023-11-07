<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleTable extends Component
{
    public function render()
    {
        $roles = Role::all();
        return view('livewire.admin.role-table', compact('roles'));
    }
}
