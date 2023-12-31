<div class="w-full">
    @php
        $replyUser = $reply->user;
    @endphp
    <div class="w-full flex items-start space-x-3">
        <div>
            @if(!$replyUser->hasMedia('avatar'))
                <img src="{{ asset('avatar.png') }}" alt="{{ $replyUser->username }}" class="bg-slate-950 w-10 h-10 rounded">
            @else
                <img src="{{ $replyUser->getFirstMediaUrl('avatar') }}" alt="{{ $replyUser->username }}" class="bg-slate-950 w-10 h-10 rounded">
            @endif
        </div>
        <div class="w-full">
            <div>
                <div class="flex space-x-1.5 items-center">
                    <h5 class="text-gray-200 text-sm">{{ $replyUser->name }}</h5>
                    <h6 class="text-gray-400 text-xs font-light">{{ $reply->created_at->diffForHumans() }}</h6>
                </div>
                <span class="text-yellow-400 text-sm font-semibold">{{ $replyUser->username }}</span>
            </div>
            <div class="my-2">
                <p class="text-gray-200 text-sm">{{ $reply->body }}</p>
            </div>
            <div class="space-y-5" x-data="{ reply: false }">
                @auth
                    <ul class="flex items-center space-x-4">
                        <li>
                            <a class="cursor-pointer text-yellow-400" @click="reply = !reply">
                                <i class="fa-solid fa-reply"></i>
                            </a>
                        </li>
                        <li>
                            @if (!$reply->likesDislikes()->where('user_id', auth()->id())->where('reaction', 'like')->exists())
                                <a class="text-yellow-400 cursor-pointer" wire:click="toogleReaction({{ $reply->id }}, 'like')">
                                    <i class="fa-regular fa-thumbs-up"></i> <span class="text-sm">({{ $reply->likesDislikes->where('reaction', 'like')->count() }})</span>
                                </a>
                            @else
                                <a class="text-yellow-400 cursor-pointer" wire:click="toogleReaction({{ $reply->id }}, 'like')">
                                    <i class="fa-solid fa-thumbs-up"></i> <span class="text-sm">({{ $reply->likesDislikes->where('reaction', 'like')->count() }})</span>
                                </a>
                            @endif
                        </li>
                        <li>
                            @if(!$reply->likesDislikes()->where('user_id', auth()->id())->where('reaction', 'dislike')->exists())
                                <a class="text-yellow-400 cursor-pointer" wire:click="toogleReaction({{ $reply->id }}, 'dislike')">
                                    <i class="fa-regular fa-thumbs-down"></i> <span class="text-sm">({{ $reply->likesDislikes->where('reaction', 'dislike')->count() }})</span>
                                </a>
                            @else
                                <a class="text-red-600 cursor-pointer" wire:click="toogleReaction({{ $reply->id }}, 'dislike')">
                                    <i class="fa-solid fa-thumbs-down"></i> <span class="text-sm">({{ $reply->likesDislikes->where('reaction', 'dislike')->count() }})</span>
                                </a>
                            @endif
                        </li>
                    </ul>
                @endauth

                <div class="w-full" x-show="reply" @click.outside="reply = false" x-transition x-cloak>
                    @auth
                        <livewire:user.episode.comment-reply :comment="$reply" />
                    @else
                        <div class="w-full">
                            <p class="text-gray-200 text-start text-sm font-semibold">You need to <a href="{{ route('login') }}" class="text-yellow-600 underline underline-offset-4">login</a> to reply</p>
                        </div>
                    @endauth
                </div>
                <div class="mt-5">
                    @foreach($reply->replies as $reply)
                        <livewire:user.episode.reply :reply="$reply" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
