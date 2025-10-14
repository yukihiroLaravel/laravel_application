@extends('layouts.app')

@section('content')
    <h2 class="mt-5">動画を登録する</h2>
    <form method="POST" action="{{ route('movie.store') }}">
        @csrf
        <div class="form-group mt-5">
            <label for="youtube_id" class="text-success">新規登録YouTube動画 "ID" を入力する</label>
            <p>
                例）登録したいYouTube動画のURLが
                <span>https://www.youtube.com/watch?v=-bNMq1Nxn5o</span>
                の場合、<br>
                "v=" の直後にある <span class="text-success">-bNMq1Nxn5o</span> を入力してください。
            </p>
            <input id="youtube_id" type="text" class="form-control" name="youtube_id"
                   value="{{ old('youtube_id') }}" placeholder="例: -bNMq1Nxn5o">
            @error('youtube_id')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="title">動画タイトル（任意）</label>
            <input id="title" type="text" class="form-control" name="title"
                   value="{{ old('title') }}" placeholder="動画タイトルを入力">
        </div>

        <button type="submit" class="btn btn-primary mt-5 mb-5">登録する</button>
    </form>

    <h2 class="mt-5">あなたの登録済み動画</h2>
    @include('movies.movies', ['movies' => $movies])
@endsection