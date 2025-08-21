@extends('layouts.app')
@section('content')
    <h2>動画検索結果</h2>

    <form action="{{ route('movies.search') }}" method="GET">
        <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="キーワードを入力">
        <button type="submit">検索</button>
    </form>

    @if(count($movies) > 0)
        @include('movies.movies', ['movies' => $movies])
    @else
        <p>検索結果はありませんでした。</p>
    @endif
@endsection