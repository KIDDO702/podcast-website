<?php

namespace App\Livewire\Host\Episode;

use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public $episode;
    public $pagination = 5;

    public function render()
    {
        $comments = Comment::where('episode_id', $this->episode->id)
            ->orderBy('created_at', 'desc')
            ->paginate($this->pagination);

        return view('livewire.host.episode.comments', compact('comments'));
    }
}
