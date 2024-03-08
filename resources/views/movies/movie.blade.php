@extends('layouts.app')
@section('content')
    <div class="movie_detail">
        <iframe
            src="{{ 'https://www.youtube.com/embed/' . $movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}"
            frameborder="0"></iframe>
        <p>{{ $movie->title }}</p>
        @foreach ($movie->hashtags as $hashtag)
            #{{ $hashtag->name }}
        @endforeach
    </div>

    <div class="movie_detail">
        @if (Auth::check())
            <form method="POST" action="{{ route('comment.store', $movie->id) }}">
                @csrf
                <div class="form-group mt-1">
                    <label for="comment" class="mt-3">コメント投稿</label>
                    <input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}">
                    <button type="submit" class="btn btn-primary mt-1">投稿</button>
                </div>
            </form>
        @endif

        <h3 class="mt-3">コメント</h3>
        @include('movies.comments', ['movie' => $movie])
    </div>
@endsection
