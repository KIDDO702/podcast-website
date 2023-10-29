<?php

namespace App\Livewire\Host;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;

class GenreEdit extends Component
{
    use WireToast;

    public $genre;
    public $name;

    protected $rules = [
        'name' => 'required|string|min:3'
    ];

    public function mount($genre)
    {
        $this->genre = $genre;
    }

    // public function update()
    // {
    //     $validated = $this->validate();

    //     try {

    //         $this->genre->name = $validated['name'];
    //         $this->genre->slug = Str::slug($validated['name']);
    //         $this->genre->user_id = Auth::user()->id;
    //         $this->genre->update();

    //     } catch (\Throwable $th) {

    //         throw $th;
    //     }

    //     toast()
    //         ->success($this->genre->name.' updated successfully')
    //         ->pushOnNextPage();

    //     redirect()->back();


    // }


    public function render()
    {
        return view('livewire.host.genre-edit');
    }
}
