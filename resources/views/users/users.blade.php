<!-- ユーザー一覧を3列で表示し、各ユーザーの最新動画と総いいね数を表示するテンプレート -->
<h2 class="mt-5 mb-5">チャンネル一覧</h2>
<div class="movies row mt-5 text-center">
    @foreach ($users as $user)

    <!-- 各ユーザーの動画一覧から、総いいね数と最新動画を取得する -->
    <!-- 最新の動画だけ表示 Userモデルに記述したmovies()関数を使い、ユーザが所有している動画情報のうち最も最近登録された動画のみを抜き出し、 -->
    <!-- 各動画のいいね！数を足していく -->
    @php
    $movies = $user->movies()->get();
    $totalFavorites = 0;
    foreach ($movies as $movie) {
    $totalFavorites += $movie->favoriteUsers()->count();
    }

    $movie = $user->movies->last();
    @endphp
    <!-- iteration:何回目の繰り返しか  -->
    @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
</div>
<div class="row text-center mt-3">
    @endif
    <!-- 各ユーザーの動画情報を表示する-->
    <div class="col-lg-4 mb-5">
        <div class="movie text-left d-inline-block">
            <!-- いいね！数のバッジを各動画右上に追加 -->
            <div class="text-right">
                <span class="badge badge-pill badge-success">{{ $totalFavorites }} いいね!</span>
            </div>

            <a href="{{ route('user.show', $user->id) }}">＠{{ $user->name }}</a>
            <div>
                <!-- ユーザーが動画を持っている場合、動画を埋め込む -->
                <!-- ユーザーが動画を持っていない場合、真っ暗な画面が表示される -->
                @if ($movie)
                <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
                @else
                <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                @endif
            </div>
            <p>
                <!-- 動画のタイトルが存在する場合、タイトルを表示 -->
                @if (isset($movie->title))
                {{ $movie->title }}
                @endif
            </p>
        </div>
    </div>
    @endforeach
</div>
<!-- links：Laravelに備え付けの関数 bootstrapのバージョン4を利用してページネーションを表示する -->
{{ $users->links('pagination::bootstrap-4') }}