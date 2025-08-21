@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-dark">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ<br>× コミュニケーション</h1>
        </div>
    </div>
    <h5 class="description text-center">みんなの"オススメ"動画を自由にシェアしよう</h5>

     {{-- 検索フォームは /movies/search に飛ばす --}}
    <form action="{{ route('movies.search') }}" method="GET">
        <input type="text" name="keyword" value="" placeholder="キーワードを入力">
        <button type="submit">検索</button>
    </form>

    @include('users.users', ['users' => $users])
@endsection