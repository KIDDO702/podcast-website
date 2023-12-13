<?php

namespace App\Livewire\Admin\Trash;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class DeletedGenres extends Component
{
    use WithPagination, WireToast;

    public $pagination = 5;

    public function restoreGenre(string $id)
    {
        $genre = Genre::onlyTrashed()
            ->where('id', $id)->first();

        $genre->restore();

        toast()
            ->success('Genre restored successfully')
            ->pushOnNextPage();

        redirect()->route('admin.trash');
    }

    public function deleteGenre(string $id)
    {
        $genre = Genre::onlyTrashed()
            ->where('id', $id)->first();

        $genre->forceDelete();

        toast()
            ->success('Genre deleted successfully')
            ->pushOnNextPage();

        redirect()->route('admin.trash');
    }


    public function updatePerPage($newPerPage)
    {
        $this->pagination = $newPerPage;
    }

    public function render()
    {
        $genres = Genre::onlyTrashed()->paginate($this->pagination);
        return view('livewire.admin.trash.deleted-genres', compact('genres'));
    }
}
