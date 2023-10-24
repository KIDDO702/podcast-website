<?php

namespace App\Livewire\Admin;

use App\Models\Genre;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Usernotnull\Toast\Concerns\WireToast;

class GenreCreate extends Component
{
    use WireToast;

    public $name;

    protected $rules = [
        'name' => 'required|unique:genres,name|string|min:3'
    ];

    public function submit()
    {
        $this->validate();

        try {

            Genre::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name)
            ]);

        } catch (\Throwable $th) {

            Log::error($th);
        }

        toast()
            ->success('Genre Created successfully')
            ->pushOnNextPage();

        redirect()->route('admin.genre');

    }

    public function render()
    {
        return view('livewire.admin.genre-create');
    }
}
