<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class RolePermissionTable extends Component
{

    public $role;

    public function mount($role)
    {
        $this->role = $role;
    }

    public function render()
    {
        return view('livewire.admin.role-permission-table');
    }
}
