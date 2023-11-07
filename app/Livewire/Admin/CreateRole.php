<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Usernotnull\Toast\Concerns\WireToast;

class CreateRole extends Component
{
    use WireToast;

    public $name;

    protected $rules = [
        'name' => 'required|unique:roles,name|string|min:3'
    ];

    public function submit()
    {
        $this->validate();

        try {

            Role::create([
                'name' => $this->name
            ]);
        } catch (\Throwable $th) {

            Log::error($th);
        }

        toast()
            ->success('Role Created successfully')
            ->pushOnNextPage();

        redirect()->route('admin.role');
    }

    public function render()
    {
        return view('livewire.admin.create-role');
    }
}
