<div class="w-full space-y-5">
    @foreach($comments as $comment)
        @php
            $user = $comment->user
        @endphp
        <div class="w-full">
            <div class="flex items-start space-x-5">
                <div>
                    @if(!$user->hasMedia('avatar'))
                        <img src="{{ asset('avatar.png') }}" alt="{{ $user->username }}" class="bg-slate-950 rounded-lg w-12 h-12 rounded">
                    @else
                        <img src="{{ $user->getFirstMediaUrl('avatar') }}" alt="{{ $user->username }}" class="bg-slate-950 rounded-lg w-12 h-12 rounded">
                    @endif
                </div>
                <div class="">
                    <div>
                        <div class="flex space-x-1.5 items-center">
                            <h5 class="text-gray-200 text-sm">{{ $user->name }}</h5>
                            <h6 class="text-gray-400 text-xs font-light">{{ $comment->created_at->diffForHumans() }}</h6>
                        </div>
                        <span class="text-yellow-400 text-sm font-semibold">{{ $user->username }}</span>
                    </div>
                    <div class="mt-2">
                        <p class="text-gray-200">{{ $comment->body }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>