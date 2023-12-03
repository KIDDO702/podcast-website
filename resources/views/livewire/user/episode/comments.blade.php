<div class="text-gray-200">
    @foreach ($comments as $comment)
        <p>{{ $comment->body }}</p>
    @endforeach
</div>
