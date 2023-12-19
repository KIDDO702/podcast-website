<?php

namespace App\Livewire\User\Episode;

use App\Models\Comment;
use Livewire\Component;
use App\Models\CommentLikeDislike;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{
    public $episode;

    // The like and dislike functionality
    public function toogleReaction($commentId, $reaction)
    {
        // Get the comment and the user
        $comment = Comment::find($commentId);
        $user = auth()->user();

        // Check if the user has already reacted to the comment
        $existingReaction = $comment->likesDislikes()->where('user_id', $user->id)->first();

        if ($existingReaction) {

            // User has already reacted, toggle the reaction or remove it
            if ($existingReaction->reaction === $reaction) {
                $existingReaction->delete();
            }
            else {
                $existingReaction->update([
                    'reaction' => $reaction // Switch to the other reaction
                ]);
            }
        }
        else {

            // User has not reacted add the reaction
            CommentLikeDislike::create([
                'user_id' => $user->id,
                'comment_id' => $commentId,
                'reaction' => $reaction
            ]);

        }
    }

    public function render()
    {
        $comments = Comment::with([
            'replies' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->where('episode_id', $this->episode->id)
            ->where('approved', true)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.user.episode.comments', compact('comments'));
    }
}


