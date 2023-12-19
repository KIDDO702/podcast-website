<?php

namespace App\Livewire\User;

use App\Models\Comment;
use Livewire\Component;

class LatestComments extends Component
{
    public function render()
    {
        $comments = Comment::where('parent_id', null)
                             ->where('approved', true)
                             ->orderBy('created_at', 'desc')
                             ->paginate(5);
        return view('livewire.user.latest-comments', compact('comments'));
    }
}
