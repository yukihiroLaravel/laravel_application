@extends('layouts.app')

@section('content')
    <h1>動画詳細</h1>

    @php
        $videoTitle = "※動画が未登録です";

        if ($movie) {
            $keyName = config('app.YouTubeDataApiKey');
            $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $apiUrl);
            $jsonData = $response->getBody()->getContents();

            if ($jsonData) {
                $decodedData = json_decode($jsonData, true);

                if ($decodedData['pageInfo']['totalResults'] !== 0) {
                    $videoTitle = $decodedData['items']['0']['snippet']['title'];
                }
            } else {
                $videoTitle = "※一時的な情報制限中です";
            }
        }
    @endphp

    <div class="movie mb-5">
        <div class="text-right mb-2">
            いいね！
            <span class="badge badge-pill badge-success">
                {{ $movie->favoriteUsers()->count() }}
            </span>
        </div>

        <div class="text-center mb-3">
            <iframe
                width="560"
                height="315"
                src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}"
                frameborder="0">
            </iframe>
        </div>

        <h2>
            @if (isset($movie->title))
                {{ $movie->title }}
            @else
                {{ $videoTitle }}
            @endif
        </h2>

        <p>
            投稿者：{{ $movie->user->name }}
        </p>

        @include('favorite.favorite_button', ['movie' => $movie])

        @if (Auth::id() === $movie->user_id)
            <div class="d-flex justify-content-between mt-3">
                <form method="POST" action="{{ route('movie.delete', $movie->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">この動画を削除する</button>
                </form>

                <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary">編集する</a>
            </div>
        @endif
    </div>
    @include('comments.form', ['movie' => $movie])
    @include('comments.comments', ['comments' => $comments])
@endsection