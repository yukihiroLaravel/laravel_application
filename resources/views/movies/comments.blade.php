@if ($movie->comments->count() == 0)
    <p>コメントはまだありません。</p>
@endif

@foreach ($movie->comments as $comment)
    <div class="comment mb-1">
        <p>
            {{ $comment->user->name }}：{{ $comment->comment }}
        </p>
        @if ($comment->user->id == Auth::id())
            <form method="POST" action="{{ route('comment.delete', $comment->id) }}" class="cmt_del">
                @csrf
                @method('DELETE')
                <button type="submit">
                    <p>削除する</p>
                </button>
            </form>
        @endif
    </div>
@endforeach
