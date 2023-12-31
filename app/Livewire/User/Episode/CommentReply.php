<?php

namespace App\Livewire\User\Episode;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CommentReply extends Component
{

    public $comment;
    public $body;

    protected $rules = [
        'body' => 'required'
    ];

    protected $messages = [
        'body.required' => 'A reply cannot be empty :('
    ];

    public function reply()
    {
        $this->validate();

        $episodeId = $this->comment->episode->id;
        $episodeSlug = $this->comment->episode->slug;

        $showSlug = $this->comment->episode->show->slug;

        Comment::create([
            'user_id' => Auth::user()->id,
            'episode_id' => $episodeId,
            'parent_id' => $this->comment->id,
            'body' => $this->body
        ]);

        $this->reset('body');

        redirect()->route('show.litsen', [
            'show' => $showSlug,
            'ep' => $episodeSlug
        ]);
    }

    public function render()
    {
        return view('livewire.user.episode.comment-reply');
    }
}
