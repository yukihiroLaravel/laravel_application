<div class="movies row mt-5 text-center">
    @foreach ($movies as $movie)
        @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
            </div>
            <div class="row text-center mt-3">
        @endif
            <div class="col-lg-4 mb-5">
                <div class="movie text-left d-inline-block">
                    @php
                        $countFavoriteUsers = $movie->favoriteUsers()->count();
                        $videoTitle="※動画が未登録です";
                        if ($movie) {
                            $keyName = config('app.YouTubeDataApiKey');
                            $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
                            $jsonData = file_get_contents($apiUrl);
                            if ($jsonData) {
                                $decodedData = json_decode($jsonData, true);
                                if ($decodedData['pageInfo']['totalResults'] !== 0){
                                    $videoTitle = $decodedData['items']['0']['snippet']['title'];
                                }
                            } else {
                                $videoTitle="※一時的な情報制限中です";
                            }
                        }
                    @endphp
                    <div class="text-right mb-2">いいね！
                        <span class="badge badge-pill badge-success">{{ $countFavoriteUsers }}</span>
                    </div>
                    <div>
                        @if ($movie)
                            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
                        @else
                            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                        @endif
                    </div>
                    <p>
                        @if (isset($movie->title))
                            {{ $movie->title }}
                        @else
                            {{ $videoTitle }}
                        @endif
                    </p>
                    @include('favorite.favorite_button', ['movie' => $movie])
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