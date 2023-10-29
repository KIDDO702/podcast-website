<?php

namespace App\Livewire\Host;

use App\Models\Genre;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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
                'slug' => Str::slug($this->name),
                'user_id' => Auth::user()->id
            ]);
        } catch (\Throwable $th) {

            Log::error($th);
        }

        toast()
            ->success('Genre Created successfully')
            ->pushOnNextPage();

        redirect()->route('host.genre');
    }

    public function render()
    {
        return view('livewire.host.genre-create');
    }
}
