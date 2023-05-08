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
            $apiUrl =
            "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
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
            @include('favorite.favorite_button', ['movie' => $movie])
            @if (Auth::id() === $movie->user_id)
            <div class="d-flex justify-content-between">
                <form method="POST" action="{{ route('movie.delete', $movie->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg> この動画を削除する
                    </button>
                </form>
                <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil" viewBox="0 0 16 16">
                        <path
                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                    </svg> 編集する
                </a>
            </div>
            @endif
            <div class="line-height my-3">
                <div id="comment-article-{{ $movie->id }}">
                    @include('movies.comment_list')
                </div>
                <div class="">
                    <form method="POST" action="{{ route('comment.store') }}" accept-charset="UTF-8" data-remote="true">
                        <input name="utf8" type="hidden" value="&#x2713;" />
                        @csrf
                        <div class="form-group">
                            <input value="{{ $movie->id }}" type="hidden" name="movie_id" />
                            <input value="{{ Auth::id() }}" type="hidden" name="user_id" />
                            <textarea id="comment" class="form-control" placeholder="コメント ..." autocomplete="off"
                                name="comment" value="{{ old('comment') }}" cols="50" rows="2"></textarea>
                            <button type="button" onclick="submit();" class="btn btn-info mt-1 mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chat-square-text" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                </svg> コメントする
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $movies->links('pagination::bootstrap-4') }}