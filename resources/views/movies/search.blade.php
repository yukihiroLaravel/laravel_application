@extends('layouts.app')
@section('content')
  <h1>動画検索結果</h1>
  @if ($message)
    <div class="alert alert-warning">
      {{ $message }}
    </div>
  @else
    @if ($movies->total() > 0)

      <p>

        『{{ $keyword }}』で検索した結果、{{ $movies->total() }}件が見つかりました。

      </p>

      @include('movies.movies', ['movies' => $movies])

    @else

      <p>

        『{{ $keyword }}』に一致する動画は見つかりませんでした。

      </p>
    @endif
    
  @endif
@endsection