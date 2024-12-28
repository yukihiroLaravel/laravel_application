<div class="comment-list">
    @foreach ($comments as $comment)
    <div class="media mb-4">
        <img class="mr-3 rounded-circle" src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('images/default_' . ($comment->user->gender ?? 'unknown') . '.png') }}" alt="{{ $comment->user->name }}" width="100">
        <div class="media-body">
            <h5 class="mt-0">{{ $comment->user->name }}</h5>
            <p>{{ $comment->content }}</p>
            @if (auth()->check() && (auth()->id() === $comment->user_id || auth()->id() === $movie->user_id))
            <form class="delete-comment-form" action="{{ route('comment.delete', [$movie->id, $comment->id]) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">削除</button>
            </form>
            @endif
            @if (auth()->check() && auth()->id() === $comment->user_id)
            <button class="btn btn-secondary btn-sm" onclick="editComment({{ $comment->id }})">編集</button>
            <form class="edit-comment-form" id="edit-form-{{ $comment->id }}" action="{{ route('comment.update', [$movie->id, $comment->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('PUT')
                <textarea name="content" class="form-control" rows="2">{{ $comment->content }}</textarea>
                <button type="submit" class="btn btn-primary btn-sm mt-1">保存</button>
            </form>

            @endif
        </div>
    </div>
    @endforeach
    </div>