<div class="movies row mt-5 text-center">
    @foreach ($movies as $movie)
    <!-- moviesテーブル内のmovieデータ数処理を繰り返す -->
    @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
    <!-- ３つの要素ごとに新しい行を開始　かつ　1番目は除外 -->
</div>
<div class="row text-center mt-3">
    @endif
    <p>
        @if (isset($movie->comment))
        <!-- movieオブジェトにコメントが設定されているか確認（エラーメッセージ） -->
        {{ $movie->comment }}
        <!-- コメントを表示 -->
        @endif
    </p>
    @if (Auth::id() === $movie->user_id)
    <!-- ユーザーがログインしており、idが投稿者のuser_idと一致している場合 -->
    <form method="POST" action="{{ route('movie.delete', $movie->id) }}">
        @csrf
        <!-- csrfトークンを生成 -->
         <!-- セキュリティ対策、ユーザーの外部データリクエストをブロック -->
        @method('DELETE')
        <!-- deleteメソッド -->
        <button type="submit" class="btn btn-danger">この動画を削除する</button>
    </form>
    @endif
    <div class="col-lg-4 mb-5">
        <div class="movie text-left d-inline-block">
            @php
            $countFavoriteUsers = $movie->favoriteUsers()->count();
            <!-- favoritesテーブル内で対象動画をお気に入りしているユーザー数をカウント -->
                        $videoTitle="※動画が未登録です";
                        if ($movie) {
                            <!-- 動画データが存在している場合 -->
                            $keyName = config('app.YouTubeDataApiKey');
                            $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
                            $jsonData = file_get_contents($apiUrl);
                            if ($jsonData) {
                                <!-- jsonDataが存在している場合 -->
                                $decodedData = json_decode($jsonData, true);
                                if ($decodedData['pageInfo']['totalResults'] !== 0){
                                    $videoTitle = $decodedData['items']['0']['snippet']['title'];
                                }
                            } else {
                                $videoTitle="※一時的な情報制限中です";
                            }
                        }            @endphp
            <div class="text-right mb-2">いいね！
                <span class="badge badge-pill badge-success">{{ $countFavoriteUsers }}</span>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="movie text-left d-inline-block">
                    <div>
                        @if ($movie)
                        <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
                        @else
                        <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                        @endif
                    </div>
                    <p>
                        @if (isset($movie->title))
                        <!-- movieデータのtitleが存在している場合 -->
                        {{ $movie->title }}
                        <!-- titleを表示 -->
                        @endif
                    </p>
                    @include('favorite.favorite_button', ['movie' => $movie])
                    <!-- favoriteフォルダのfavorite_buttonを表示、movieを$movieにして渡す -->
                    @if (Auth::id() === $movie->user_id)
                    <!-- ユーザーがログイン状態　かつ動画の投稿者idと一致している場合 -->
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
        <!-- ページネーションを設定 -->