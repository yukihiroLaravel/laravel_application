<div class="movies row text-center mt-5">
    @foreach ($users as $user)
        @php
            $movies = $user->movies()->get();
            $totalFavorites = 0;
            foreach ($movies as $movie) {
                $totalFavorites += $movie->favoriteUsers()->count();
            }
            $movie = $user->movies->last();

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
        @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
</div>
<div class="movies row text-center">
    @endif
    <div class="col-lg-4 mb-5">
        <div class="movie text-left d-inline-block">
            <div class="mb-2 d-flex justify-content-between align-items-end mr-1">
                <a href="{{ route('user.show', $user->id) }}">
                    <img src="{{ asset('storage/images' . $user->icon) }}" alt="user-icon" class="user-icon">
                    {{ $user->name }}
                </a>
                <div class="d-flex">
                    <p class="text-primary mr-1">総合</p>
                    <i class="fa fa-thumbs-up mr-1 text-primary" aria-hidden="true"></i>
                    <p class="text-secondary">{{ $totalFavorites }}</p>
                </div>
            </div>

            <div>
                @if ($movie)
                    <iframe width="290" height="163.125"
                        src="{{ 'https://www.youtube.com/embed/' . $movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}"
                        frameborder="0"></iframe>
                @else
                    <iframe width="290" height="163.125" src="https://www.youtube.com/embed/"
                        frameborder="0"></iframe>
                @endif
            </div>
            <div class="movie-title">
                @if (@isset($movie->title))
                    <p>{{ $movie->title }}</p>
                @else
                    <p>{{ $videoTitle }}</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
