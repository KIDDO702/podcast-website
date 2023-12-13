<?php

namespace App\Livewire\Admin\Trash;

use App\Models\Show;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class DeletedShows extends Component
{
    use WireToast, WithPagination;

    public $pagination = 5;

    public function restoreShow(string $id)
    {
        $show = Show::onlyTrashed()
            ->where('id', $id)->first();

        $show->restore();

        toast()
            ->success('Show restored successfully')
            ->pushOnNextPage();

        redirect()->route('admin.trash');
    }

    public function deleteShow(string $id)
    {
        $show = Show::onlyTrashed()
            ->where('id', $id)->first();

        $show->forceDelete();

        toast()
            ->success('Show deleted successfully')
            ->pushOnNextPage();

        redirect()->route('admin.trash');
    }

    public function updatePerPage($newPerPage)
    {
        $this->pagination = $newPerPage;
    }

    public function render()
    {
        $shows = Show::onlyTrashed()->paginate($this->pagination);
        return view('livewire.admin.trash.deleted-shows', compact('shows'));
    }
}
