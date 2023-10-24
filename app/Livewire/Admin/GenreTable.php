<?php

namespace App\Livewire\Admin;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class GenreTable extends Component
{
    use WireToast, WithPagination;

    public $pagination = 5;

    public function deleteGenre(Genre $genre)
    {
        if (!$genre) {

            toast()
                ->warning('No genre found')
                ->pushOnNextPage();

            redirect()->route('admin.genre');
        }

        $genre->delete();

        toast()
            ->success('Genre deleted successfully')
            ->pushOnNextPage();

        redirect(route('admin.genre'));
    }

    public function updatePerPage($newPerPage)
    {
        $this->pagination = $newPerPage;
    }


    public function render()
    {
        $genres = Genre::orderBy('created_at', 'desc')->paginate($this->pagination);

        return view('livewire.admin.genre-table', compact('genres'));
    }
}
