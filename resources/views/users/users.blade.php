<h2 class="mt-5 mb-5">チャンネル一覧</h2>
<div class="movies row mt-5 text-center">
    {{-- コントローラから受け取った変数「$users」から１人１人のユーザを取り出して繰り返す --}}
    @foreach ($users as $user)
        @php
            // ユーザが所有している全ての動画情報を取得
            // Userモデルに記述したmovies()関数を使い、ユーザが所有している動画情報を取得
            $movies = $user->movies()->get();
            // ユーザが所有している動画情報のうち、いいね！を押したユーザ数をカウント
            // $moviesはコレクションで、各動画に対してfavoriteUsers()関数を呼び出して、いいね！を押したユーザの数をカウント
            //　初期値は０だよ
            $totalFavorites = 0;
            // 各動画に対して、いいね！を押したユーザの数をカウント
            // $moviesはコレクションで、各動画に対してfavoriteUsers()関数を呼び出して、いいね！を押したユーザの数をカウント
            foreach ($movies as $movie){
                // 動画のいいね！を押したユーザ数をカウント
                // 各動画に対してfavoriteUsers()関数を呼び出して、いいね！を押したユーザの数をカウント
                // $totalFavoritesに加算
                $totalFavorites += $movie->favoriteUsers()->count();
            }
            // Userモデルに記述したmovies()関数を使い、ユーザが所有している動画情報のうち最も最近登録された動画のみを抜き出し
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

        @endphp
        {{-- $loop->iteration とは、繰り返し処理中で使えるプロパティで、「今が何回目の繰り返しか？」と示してくれる --}}
        {{-- $loop->iteration % 3 === 1は、「３で割ったら余りが１」として3回目以降で行を分ける --}}
        {{-- $loop->iteration !== 1 は、１番目のユーザが表示された直後は改行してはいけない --}}
        @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
            </div>
            <div class="row text-center mt-3">
        @endif
            <div class="col-lg-4 mb-5">
                <div class="movie text-left d-inline-block">
                    <div class="text-right">
                        <span class="badge badge-pill badge-success">{{ $totalFavorites }} いいね!</span>
                    </div> 
                <a href="{{ route('user.show', $user->id) }}">＠{{ $user->name }}
                    <div>
                        {{-- 動画が存在する場合は動画を表示、存在しない場合は空のiframeを表示 --}}
                        {{-- $movieはUserモデルのmovies()関数で取得した動画情報のうち、最新のものを指す --}}
                        {{-- $movieがnullでない場合は動画を表示し、nullの場合は空のiframeを表示 --}}
                        @if ($movie)
                            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
                        @else
                            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                        @endif
                    </div>
                    <p>
                        {{-- 動画が存在する場合のみ動画のタイトルを表示 --}}
                        {{-- isset()関数は、変数が定義されているかどうかを確認する --}}
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
{{-- ページ送り機能の次ページリンクをこの部分に挿入する --}}
{{-- $usersはコントローラから受け取ったページネーション済みのユーザ情報 --}}
{{-- pagination::bootstrap-4 は、Bootstrap 4用のページネーションビューを指定 --}}
{{ $users->links('pagination::bootstrap-4') }}