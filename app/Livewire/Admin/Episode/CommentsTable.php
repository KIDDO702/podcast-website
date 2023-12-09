<?php

namespace App\Livewire\Admin\Episode;

use App\Models\Comment;
use Livewire\Component;

class CommentsTable extends Component
{

    public $episode;
    public $pagination = 5;
    public $search = '';

    public function render()
    {
        $comments = Comment::where('episode_id', $this->episode->id)
                             ->orderBy('created_at', 'desc')
                             ->paginate($this->pagination);


        return view('livewire.admin.episode.comments-table', compact('comments'));
    }

    public function updatePerPage($newPerPage)
    {
        $this->pagination = $newPerPage;
    }
}
