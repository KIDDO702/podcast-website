<?php

namespace App\Livewire\User\Episode;

use App\Models\Comment as modelComment;
use App\Models\Episode;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;

class Comment extends Component
{
    use WireToast;

    public $episode;
    public $body;

    protected $rules = [
        'body' => 'required'
    ];

    protected $messages = [
        'body.required' => 'The comment cannot be empty :('
    ];

    public function comment ()
    {
        $this->validate();

        modelComment::create([
            'user_id' => Auth::user()->id,
            'episode_id' => $this->episode->id,
            'body' => $this->body
        ]);

        $showSlug = $this->episode->show->slug;

        $this->reset('body');

        toast()
            ->success('Thank you for your comment')
            ->pushOnNextPage();

        redirect()->route('show.litsen', [
            'show' => $showSlug,
            'ep' => $this->episode->slug
        ]);
    }


    public function render()
    {
        return view('livewire.user.episode.comment');
    }
}
