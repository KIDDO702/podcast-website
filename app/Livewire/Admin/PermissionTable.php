<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionTable extends Component
{
    public function render()
    {
        $permissions = Permission::all();
        return view('livewire.admin.permission-table', compact('permissions'));
    }
}
