<h2 class="mt-5 mb-5">チャンネル一覧</h2>
<div class="movies row mt-5 text-center">
    @foreach ($users as $user)
    @php
    $movies = $user->movies()->get();
    $totalFavorites = 0;
    foreach ($movies as $movie){
    $totalFavorites += $movie->favoriteUsers()->count();
    }
    $movie = $user->movies->last();
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
    $countmovies = $user->movies()->count();
    @endphp
    @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
</div>
<div class="row text-center mt-3">
    @endif
    <div class="col-lg-4 mb-5">
        <div class="movie text-left d-inline-block">
            <div class="text-right">
                <span class="badge badge-pill badge-success">{{ $totalFavorites }} いいね!</span>
            </div>
            <a href="{{ route('user.show', $user->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-video3" viewBox="0 0 16 16">
                    <path
                        d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2Z" />
                    <path
                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783.059-.187.09-.386.09-.593V4a2 2 0 0 0-2-2H2Z" />
                </svg> {{ $user->name }}
                <div class="badge badge-secondary">動画 登録数：{{ $countmovies }}</div>
            </a>
            <div>
                @if ($movie)
                <iframe width="290" height="163.125"
                    src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}"
                    frameborder="0"></iframe>
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
        </div>
    </div>
    @endforeach
</div>
{{ $users->links('pagination::bootstrap-4') }}