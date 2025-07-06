@extends('layouts.app')
@section('content')
    <h1>{{ $movie->title }}</h1>
    <div>
        @if ($movie)
            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
        @else
            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
        @endif
    </div>
    <h2>動画へのコメント</h2>
    <ul>
        @forelse ($movie->comments as $comment)
            <li>
                {{ $comment->comment }}
                <p>投稿者: {{ $comment->user->name }}</p>  {{-- ユーザー名を表示 --}}
                <div style="display: flex;">
                    <form method="POST" action="{{ route('comment.update', $comment->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="text" name="comment" value="{{ $comment->comment }}" required>
                        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">コメントを修正</button>
                    </form>
                    <form method="POST" action="{{ route('comment.delete', $comment->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">コメントを削除</button>
                    </form>
                </div>
            </li>
        @empty
            <li>コメントはまだありません</li>
        @endforelse
    </ul>
    <h2>コメントの追加</h2>
    <form method="post" action="{{ action('CommentsController@store', $movie->id) }}">
        @csrf
        <p>
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
            <input type="text" name="comment" placeholder="コメントはここへ" value="{{ old('comment') }}" required>
            @if ($errors->has('comment'))
                <span class="error">{{ $errors->first('comment') }}</span>
            @endif
        </p>
        <p>
            <input type="submit" value="コメントの追加">
        </p>
    </form>
@endsection