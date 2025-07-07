@extends('layouts.app')

@section('content')
    <h1>動画一覧</h1>

    {{-- 検索フォーム --}}
    <form action="{{ route('movies.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="タイトルを検索">
        <button type="submit">検索</button>
    </form>

    <ul>
        @foreach ($movies as $movie)
            <li>{{ $movie->title }}</li>
        @endforeach
    </ul>
@endsection