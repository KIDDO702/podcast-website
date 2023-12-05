<div class="w-full space-y-7">
    @foreach($comments as $comment)
        @php
            $user = $comment->user
        @endphp
        <div class="w-full">
            <div class="flex items-start space-x-5">
                <div>
                    @if(!$user->hasMedia('avatar'))
                        <img src="{{ asset('avatar.png') }}" alt="{{ $user->username }}" class="bg-slate-950 w-12 h-12 rounded-lg">
                    @else
                        <img src="{{ $user->getFirstMediaUrl('avatar') }}" alt="{{ $user->username }}" class="bg-slate-950 w-12 h-12 rounded-lg">
                    @endif
                </div>
                <div class="w-full">
                    <div>
                        <div class="flex space-x-1.5 items-center">
                            <h5 class="text-gray-200 text-sm">{{ $user->name }}</h5>
                            <h6 class="text-gray-400 text-xs font-light">{{ $comment->created_at->diffForHumans() }}</h6>
                        </div>
                        <span class="text-yellow-400 text-sm font-semibold">{{ $user->username }}</span>
                    </div>
                    <div class="my-2">
                        <p class="text-gray-200 text-sm">{{ $comment->body }}</p>
                    </div>
                    <div class="space-y-5" x-data="{ reply: false }">
                        <ul class="flex items-center space-x-4">
                            <li>
                                <a class="cursor-pointer text-yellow-400" @click="reply = !reply">
                                    <i class="fa-solid fa-reply"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-yellow-400">
                                    <i class="fa-regular fa-thumbs-up"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-yellow-400">
                                    <i class="fa-regular fa-thumbs-down"></i>
                                </a>
                            </li>
                        </ul>

                        <div class="w-full" x-show="reply" @click.outside="reply = false" x-transition x-cloak>
                            @auth
                                <livewire:user.episode.comment-reply :comment="$comment" />
                            @else
                                <div class="w-full">
                                    <p class="text-gray-200 text-start text-sm font-semibold">You need to <a href="{{ route('login') }}" class="text-yellow-600 underline underline-offset-4">login</a> to reply</p>
                                </div>
                            @endauth
                        </div>
                    </div>
                    <div class="mt-5">
                        @foreach($comment->replies as $reply)
                            <livewire:user.episode.reply :reply="$reply" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
