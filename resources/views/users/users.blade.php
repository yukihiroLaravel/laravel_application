<h2 class="mt-5 mb-5">チャンネル一覧</h2>
<div class="movies row mt-5 text-center">
    @foreach ($users as $user)

    <!-- phpを記述する宣言 -->
    <!-- 最新の動画だけ表示 -->
    @php
    $movie = $user->movies->last();
    @endphp
    <!-- iteration:何回目の繰り返しか  -->
    @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
</div>
<div class="row text-center mt-3">
    @endif
    <div class="col-lg-4 mb-5">
        <div class="movie text-left d-inline-block">
            ＠{{ $user->name }}
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