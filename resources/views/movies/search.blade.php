@extends('layouts.app')
@section('content')
    <h2 class="mt-5 mb-5">検索結果一覧</h2>
        <div style="text-align: right;">
            <form action="{{ route('search.get') }}" method="GET">
                <div class="search-form-7">
                    <label>
                        <input type="text" name="keyword" value="{{$keyword}}" placeholder="動画の検索" style="width: 200px;">
                    </label>
                    <button type="submit">検索</button>
                </div>
            </form>
        </div>
    <div class="movies row mt-5 text-center">
        @foreach ($searchmovies as $searchmovie)
            @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
                <div class="row text-center mt-3">
                </div>
            @endif
                <div class="col-lg-4 mb-5">
                    <div class="movie text-left d-inline-block">
                        <div class="col-lg-4 mb-5">
                            <div class="movie text-left d-inline-block">
                            </div>
                        </div>
                        <div>
                            @if ($searchmovie)
                                <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$searchmovie->youtube_id }}?controls=1&loop=1&playlist={{ $searchmovie->youtube_id }}" frameborder="0"></iframe>
                            @else
                                <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                            @endif
                        </div>
                        <p>
                            @if (isset($searchmovie->title))
                                {{ $searchmovie->title }}
                            @endif
                        </p> 
                    </div>
                </div>
        @endforeach
    </div>
    {{ $searchmovies->links('pagination::bootstrap-4') }}
@endsection
