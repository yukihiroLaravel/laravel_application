@extends('layouts.app')

@section('content')
    <h2>検索結果：{{ $keyword }}</h2>

    @if($movies->isEmpty())
        <p>該当する動画は見つかりませんでした。</p>
    @else
        <ul>
        @foreach ($movies as $movie)
    <div style="margin-bottom: 20px;">
        <h4>{{ $movie->title }}</h4>
        <iframe width="290" height="163.125"
            src="https://www.youtube.com/embed/{{ $movie->youtube_id }}"
            frameborder="0"
            allowfullscreen>
        </iframe>
    </div>
        @endforeach
        </ul>
    @endif

    <a href="{{ route('movies.index') }}">トップページに戻る</a>
@endsection