<?php

namespace App\Livewire\Admin\Trash;

use App\Models\Episode;
use Livewire\Component;
use Livewire\WithPagination;

class DeletedEpisodes extends Component
{
    use WithPagination;

    public $pagination = 5;

    public function restoreEpisode(string $id)
    {
        $episode = Episode::onlyTrashed()
                            ->where('id', $id)->first();

        $episode->restore();

        toast()
            ->success('Episode restored successfully')
            ->pushOnNextPage();

        redirect()->route('admin.trash');
    }

    public function deleteEpisode(string $id)
    {
        $episode = Episode::onlyTrashed()
            ->where('id', $id)->first();

        $episode->forceDelete();

        toast()
            ->success('Episode deleted successfully')
            ->pushOnNextPage();

        redirect()->route('admin.trash');
    }

    public function updatePerPage($newPerPage)
    {
        $this->pagination = $newPerPage;
    }

    public function render()
    {
        $episodes = Episode::onlyTrashed()->paginate($this->pagination);
        return view('livewire.admin.trash.deleted-episodes', compact('episodes'));
    }
}
