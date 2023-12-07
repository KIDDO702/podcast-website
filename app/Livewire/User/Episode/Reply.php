<?php

namespace App\Livewire\User\Episode;

use App\Models\Comment;
use Livewire\Component;
use App\Models\CommentLikeDislike;

class Reply extends Component
{
    public $reply;

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
            } else {
                $existingReaction->update([
                    'reaction' => $reaction // Switch to the other reaction
                ]);
            }
        } else {

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
        return view('livewire.user.episode.reply');
    }
}
