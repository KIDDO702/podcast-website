<?php

namespace App\Livewire\User\Episode;

use App\Models\Comment;
use Livewire\Component;
use App\Models\CommentLikeDislike;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{
    public $episode;

    public function likeComment($commentId)
    {

        $comment = Comment::find($commentId);
        $showSlug = $this->episode->show->slug;

        // Check if comment exists
        if($comment->likesDislikes()->where('user_id', auth()->user()->id)->where('reaction', 'like')->exists())
        {
            // User has already liked, remove the like
            $comment->likesDislikes()->where('user_id', auth()->user()->id)->delete();

        }
        else {

            // Add the like
            CommentLikeDislike::create([
                'user_id' => Auth::user()->id,
                'comment_id' => $commentId,
                'reaction' => 'like'
            ]);

        }

    }

    public function render()
    {
        $comments = Comment::where('episode_id', $this->episode->id)
                             ->whereNull('parent_id')
                             ->orderBy('created_at', 'desc')
                             ->get();
        return view('livewire.user.episode.comments', compact('comments'));
    }
}


