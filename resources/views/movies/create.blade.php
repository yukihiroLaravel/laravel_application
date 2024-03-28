@extends('layouts.app')
@section('content')
    <h2 class="mt-5">Add Movie</h2>
    <form method="POST" action="{{ route('movie.store') }}">
        @csrf
        <div class="form-group mt-5">
            <div class="form-group">
                <label for="youtube_id" class="text-success">Type New register Youtube Movie"ID"</label>
                <p>ex）登録したいYouTube動画のURLが?<span>https://www.youtube.com/watch?v=-bNMq1Nxn5o?なら</span>
                   <br>"v="の直後にある?"<span class="text-success">-bNMq1Nxn5o</span>"?を入力
                </p>
                <input id="youtube_id" type="text" class="form-control" name="youtube_id" value="{{ old('youtube_id') }}">
            </div>
            <div class="form-group">
                <label for="title" class="mt-3">Movie title(※any)</label>
                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="favorite_flag" class="mt-3">
                    <input id="favorite_flag" type="checkbox" name="favorite_flag" {{ old('favorite_flag', 1) == 1 ? 'checked' : '' }}>Permint Favorite!
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-5 mb-5">Submit</button>
        </div>
    </form>
    <h2 class="mt-5">Your added movie </h2>
    @include('movies.movies', ['movies' => $movies])
@endsection