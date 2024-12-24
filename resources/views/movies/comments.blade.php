@extends('layouts.app')

@section('content')
<div class="container">
    <h2>"{{ $movie->title }}" のコメント一覧</h2>
    <div class="mt-4">
        @if ($movie)
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" allowfullscreen></iframe>
        </div>
        @else
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/" allowfullscreen></iframe>
        </div>
        @endif
    </div>


    @auth
    <form action="{{ route('comment.store', $movie->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">コメントを投稿:</label>
            <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">投稿する</button>
    </form>
    @else
    <p><a href="{{ route('login') }}">ログイン</a>してコメントを投稿してください。</p>
    @endauth

    <hr>

    @foreach ($comments as $comment)
    <div class="media mb-4">
    <img class="mr-3 rounded-circle" src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('images/default_' . ($comment->user->gender ?? 'unknown') . '.png') }}" alt="{{ $comment->user->name }}" width="100">
        <div class="media-body">
            <h5 class="mt-0">{{ $comment->user->name }}</h5>
            <p>{{ $comment->content }}</p>
            @if (auth()->check() && (auth()->id() === $comment->user_id || auth()->id() === $movie->user_id))
            <form action="{{ route('comment.delete', [$movie->id, $comment->id]) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">削除</button>
            </form>
            @endif
            @if (auth()->check() && auth()->id() === $comment->user_id)
            <button class="btn btn-secondary btn-sm" onclick="editComment({{ $comment->id }})">編集</button>
            <form id="edit-form-{{ $comment->id }}" action="{{ route('comment.update', [$movie->id, $comment->id]) }}" method="POST" style="display: none;">
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

<script>
    function editComment(commentId) {
        const form = document.getElementById(`edit-form-${commentId}`);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection