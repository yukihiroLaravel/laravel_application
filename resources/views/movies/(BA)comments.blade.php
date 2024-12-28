@extends('layouts.app')

@section('content')
@include('components.success')
<div class="container">
    <h2>
        @php
        $videoTitle="※動画が未登録です";
        if ($movie) {
        $keyName = config('app.YouTubeDataApiKey');
        $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
        $jsonData = file_get_contents($apiUrl);
        if ($jsonData) {
        $decodedData = json_decode($jsonData, true);
        if ($decodedData['pageInfo']['totalResults'] !== 0){
        $videoTitle = $decodedData['items']['0']['snippet']['title'];
        }
        } else {
        $videoTitle="※一時的な情報制限中です";
        }
        }
        @endphp
        @if (isset($movie->title))
        {{ $movie->title }}
        @else
        {{ $videoTitle }}
        @endif
        のコメント一覧
    </h2>
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

    <!--descriptionの表示-->
    <div class="my-3 p-3 border rounded bg-light">
        <h5 class="text-success">動画説明</h5>
        @if (!empty($movie->description))
        <p>{!! nl2br(e($movie->description)) !!}</p>
        @else
        <p class="text-muted">※この動画には説明が登録されていません。</p>
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
            <p style="font-size: 0.8em;">{{ $comment->created_at ->format('Y-n-d H:i:s') }}
                @if ($comment->updated_at && $comment->updated_at->ne($comment->created_at))
                （ 編集済み）
                @endif
            </p>
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