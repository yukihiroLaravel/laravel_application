<div class="movies row text-center mt-5">
    @foreach ($movies as $movie)
        @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
</div>
<div class="movies row text-center">
    @endif
    <div class="col-lg-4 mb-5">
        <div class="movie text-left d-inline-block">
            @php
                $countFavoriteUsers = $movie->favoriteUsers()->count();

                $videoTitle = '*動画が未登録です。';
                if ($movie) {
                    $keyName = config('app.YouTubeDataApiKey');
                    $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
                    $jsonData = file_get_contents($apiUrl);
                    if ($jsonData) {
                        $decodedData = json_decode($jsonData, true);
                        if ($decodedData['pageInfo']['totalResults'] !== 0) {
                            $videoTitle = $decodedData['items']['0']['snippet']['title'];
                        }
                    } else {
                        $videoTitle = '*一時出来な情報制限中です。';
                    }
                }
            @endphp
            <ul class="d-flex justify-content-end">
                <li class="d-flex">
                    <i class="fa fa-thumbs-up mr-1 text-primary" aria-hidden="true"></i>
                    <p class="mr-3 text-secondary">{{ $countFavoriteUsers }}</p>
                </li>
                <li class="d-flex">
                    <i class="fa fa-comment-alt mr-1 text-success" aria-hidden="true"></i>
                    <p class="text-secondary">{{ $movie->comments->count() }}</p>
                </li>
            </ul>
            <div>
                @if ($movie)
                    <iframe width="290" height="163.125"
                        src="{{ 'https://www.youtube.com/embed/' . $movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}"
                        frameborder="0"></iframe>
                @else
                    <p>まだ動画が登録されていません。</p>
                @endif
            </div>
            <div class="movie-title">
                <p>{{ $movie->title }}</p>
            </div>

            <div class="d-flex justify-content-end mb-2">
                @include('favorite.favorite_button', ['movie' => $movie])
                @include('comment.comment_button', ['movie' => $movie])
            </div>

            @if (Auth::id() === $movie->user_id)
                <div class="d-flex justify-content-between">
                    <form method="POST" action="{{ route('movie.delete', $movie->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">この動画を削除する</button>
                    </form>
                    <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary">編集する</a>
                </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
{{ $movies->links('pagination::bootstrap-4') }}
