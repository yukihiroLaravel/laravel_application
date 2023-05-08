@extends('layouts.app')
@section('content')
<h2 class="mt-5">動画を編集する</h2>
<form method="POST" action="{{ route('movie.update', $movie->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group mt-5">
        <div class="form-group">
            <label for="youtube_id" class="text-success">新規登録YouTube動画 "ID" を入力する</label>
            <p>例）登録したいYouTube動画のURLが<span> "https://www.youtube.com/watch?v=-bNMq1Nxn5o" なら</span>
                <br>"v=" の直後にある "<span class="text-success">-bNMq1Nxn5o</span>" を入力
            </p>
            <input id="youtube_id" type="text" class="form-control" name="youtube_id"
                value="{{ old('youtube_id', $movie->youtube_id) }}">
        </div>
        <div class="form-group">
            <label for="title" class="mt-3">動画タイトル(※任意)</label>
            <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $movie->title) }}">
        </div>
        <div class="form-group">
            <label for="favorite_flag" class="mt-3">
                <input id="favorite_flag" type="checkbox" name="favorite_flag" {{ old('favorite_flag',
                    $movie->favorite_flag) == 1 ? 'checked' : '' }}>
                いいね！を許可する
            </label>
        </div>
        <button type="submit" class="btn btn-primary mt-5 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload"
                viewBox="0 0 16 16">
                <path
                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                <path
                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
            </svg> 登録する
        </button>
    </div>
</form>
<h2 class="mt-5">あなたの登録済み動画</h2>
@include('movies.movies', ['movies' => $movies])
@endsection