@extends('layouts.app')
@section('content')
    <h2 class="mt-5">動画を登録する</h2>
    {{-- form methodはデータを送信するために使用するHTTPメソッド(getまたはpost)を定義 --}}
    {{-- GETメソッドは、データをURLのクエリパラメータとして送信するために使用される（データがURLの後ろに表示されて送信される。） --}}
    {{-- POSTメソッドは、データをリクエストボディに含めて送信するために使用される（URLの後ろにデータを表示しないで送信する） --}}
    {{-- action属性は、フォームが送信されたときにデータを送信するURLを指定 --}}
    {{-- route('movie.store')は、web.phpで定義されたルートの名前を参照 --}}

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
            <div class="form-group">
                <label for="title" class="mt-3">動画タイトル(※任意)</label>
                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
            <button type="submit" class="btn btn-primary mt-5 mb-5">登録する</button>
        </div>
    </form>
    <h2 class="mt-5">あなたの登録済み動画</h2>
    {{-- movies変数は、MovieControllerで取得した動画一覧 --}}
    {{-- movies.blade.phpで、動画一覧を表示 --}}
    @include('movies.movies', ['movies' => $movies])
@endsection
