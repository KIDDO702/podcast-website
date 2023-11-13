<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Usernotnull\Toast\Concerns\WireToast;

class PermissionCreate extends Component
{
    use WireToast;

    public $name;

    protected $rules = [
        'name' => 'required|unique:permissions,name|string|min:3'
    ];

    public function submit()
    {
        $this->validate();

        try {

            Permission::create([
                'name' => $this->name
            ]);
        } catch (\Throwable $th) {

            Log::error($th);
        }

        toast()
            ->success('Permission Created successfully')
            ->pushOnNextPage();

        redirect()->route('admin.permission');
    }

    public function render()
    {
        return view('livewire.admin.permission-create');
    }
}
