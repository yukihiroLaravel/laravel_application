@extends('layouts.app')
@section('content')
    <h2>動画登録する</h2>
    <form method="POST" action="{{ route('movie.store') }}">
        @csrf
        <div class="form-group mt-5">
            <div class="form-group">
                <label for="youtube_id" class="text-success">新規登録YouTube動画"ID"を入力する</label>
                <p>
                    例）登録したいYouTube動画のURLが?<span>https://www.youtube.com/watch?v=-bNMq1Nxn5o?なら</span>
                    <br>"v="の直後にある?"<span class="text-success">-bNMq1Nxn5o</span>"?を入力
                </p>
                <input type="text" name="youtube_id" id="youtube_id" value="{{ old('youtube_id') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="title" class="mt-3">動画タイトル（＊空欄の場合はyoutubeのタイトルが登録されます）</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="favorite_flag" class="mt-3">
                    <input type="checkbox" name="favorite_flag" id="favorite_flag"
                        {{ old('favorite_flag', 1) == 1 ? 'checked' : '' }}>いいね！を許可する
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-5 mb-5">登録する</button>
        </div>
    </form>
    <h2 class="mt-5">あなたの登録済み動画</h2>
    @include('movies.movies', ['movies' => $movies])
@endsection
