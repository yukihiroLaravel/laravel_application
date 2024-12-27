@extends('layouts.app')
@section('content')
<h2 class="mt-5">動画を登録する</h2>
<form method="POST" action="{{ route('movie.store') }}">
  @csrf
  <div class="form-group mt-5">
    <div class="form-group">
      <label for="youtube_id" class="text-success">新規登録YouTube動画 "ID" を入力する</label>
      <p>例）登録したいYouTube動画のURLが?<span>https://www.youtube.com/watch?v=-bNMq1Nxn5o?なら</span>
        <br>"v="の直後にある?"<span class="text-success">-bNMq1Nxn5o</span>"?を入力
      </p>
      <input id="youtube_id" type="text" class="form-control" name="youtube_id" value="{{ old('youtube_id') }}">
    </div>
    {{-- name属性 この属性に設定された名前で、コントローラ側で処理を受け取る --}}
    {{-- old('youtube_id')は、value属性。 input要素に入力された値。old()関数は、バリデーションエラー発生時などに、カッコ内の属性の値を保持する役割がある。 --}}

    <div class="form-group">
      <label for="title" class="mt-3">動画タイトル(※任意)</label>
      <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
    </div>
    <div class="form-group">
      <label for="favorite_flag" class="mt-3">
        <input id="favorite_flag" type="checkbox" name="favorite_flag" {{ old('favorite_flag', 1) == 1 ? 'checked' : '' }}>
        いいね！を許可する
      </label>
    </div>
    <button type="submit" class="btn btn-primary mt-5 mb-5">登録する</button>
  </div>
</form>
<h2 class="mt-5">あなたの登録済み動画</h2>
@include('movies.movies', ['movies' => $movies])
{{-- moviesフォルダの中の、movies.blade.phpを表示させる。さらに、第二引数に['movies' => $movies]を入れることにより、movies.blade.phpのファイルでも、$moviesの変数が使えるようにする--}}
@endsection