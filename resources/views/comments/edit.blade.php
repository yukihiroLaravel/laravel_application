@extends('layouts.app')

@section('content')
    <h1>コメント編集</h1>

    <form method="POST" action="{{ route('comment.update', $comment->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <textarea
                name="content"
                class="form-control"
                rows="5"
                maxlength="1000"
                placeholder="コメントを入力してください"
            >{{ old('content', $comment->content) }}</textarea>

            <small class="form-text text-muted">
                最大1000文字まで入力できます。
            </small>
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>

        <a href="{{ route('movie.show', $comment->movie_id) }}" class="btn btn-secondary">
            キャンセル
        </a>
    </form>
@endsection