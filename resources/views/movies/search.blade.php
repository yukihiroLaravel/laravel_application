@extends('layouts.app')
@section('content')
  <h1>動画検索結果</h1>
  @if (empty($keyword))
      <p>全ての動画を表示しています。{{ $movies->total() }}件が見つかりました。</p>
  @else
    @if ($movies->total() > 0)
      <p>『{{ $keyword }}』で検索した結果、{{ $movies->total() }}件が見つかりました。</p>
    @else
      <p>『{{ $keyword }}』に一致する動画は見つかりませんでした。</p>
    @endif
  @endif

  @if($movies->total() > 0)
    @include('movies.movies', ['movies' => $movies])
  @endif
@endsection