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
    <div>
        <div>
            </form>
            {{-- 動画のいいね！ボタンを表示 --}}
            @include('favorite.favorite_button', ['movie' => $movie])
            {{-- 動画の持ち主であれば、動画の編集と削除ボタンを表示 --}}
            @if (Auth::id() === $movie->user_id)
                <p>
                    <div class="d-flex justify-content-between" style="width: 290px;">
                        {{-- 動画の削除フォーム --}}
                        {{-- movie.deleteは、MovieControllerのdestroyメソッドを呼び出すルート --}}
                        <form method="POST" action="{{ route('movie.delete', $movie->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">この動画を削除する</button>
                        </form>
                        <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary">編集する</a>
                    </div>
                </p>
            @endif
        </div>
    </div>
    <p>
    <div>
        <p>
        <h4>この動画へのコメント</h4>
        </p>
        <ul>
            @forelse ($movie->comments as $comment)
                <li>{{ $comment->comment }}</li>投稿者: {{ $comment->user->name }}
            @empty
                <li>コメントはまだありません</li>
            @endforelse
        </ul>
        <h5>コメントの追加</h5>
        <form method="post" action="{{ action('CommentsController@store', $movie->id) }}">
        @csrf
        <p>
            {{-- 動画IDをhiddenフィールドとして送信 --}}
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
            {{-- コメントの入力フィールド --}}
            <input type="text" name="comment" placeholder="コメントはここへ" value="{{ old('comment') }}">
            @if ($errors->has('comment'))
            <span class="error">{{ $errors->first('comment') }}</span>
            @endif
        </p>
        <p>
            <input type="submit" value="投稿する">
        </p>
           <p>
        <a href="{{ route('comment.edit', $movie->id) }}">コメントの編集</a>
    </p>
    </div>
@endsection