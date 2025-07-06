<h2 class="mt-5 mb-5">ユーザ一覧</h2>
        {{-- 検索機能ここから --}}
    <div style="text-align: right;">
        <form action="{{ route('search.get') }}" method="GET">
            <div class="search-form-7">
                <label>
                    <input type="text" name="keyword" placeholder="動画の検索" style="width: 200px;">
                </label>
                <button type="submit">検索</button>
            </div>
        </form>
    </div>
        {{-- 検索機能ここまで --}}
        {{-- foreachを使って、変数「$users」から１人１人のユーザを取り出して繰り返す --}}
<div class="movies row mt-5 text-center"><br>
    @foreach ($users as $user)
        @php
            // $moviesは、ユーザが所有している全ての動画情報を取得するための変数
            // $user->movies()は、Userモデルに定義されたmovies()メソッドを呼び出して、ユーザが所有している動画情報を全て取得
            $movies = $user->movies()->get();
            // ユーザが所有している動画のうち、いいね数の合計を計算する
            // $totalFavoritesは、ユーザが所有している動画のうち、いいね数の合計を格納する変数
            $totalFavorites = 0;
            // foreachを使って、ユーザが所有している全ての動画情報から１つずつ取り出す
            // $movieは、ユーザが所有している動画情報の１つを表す変数
            foreach ($movies as $movie){
                // $movie->favoriteUsers()は、動画にいいねをしたユーザの情報を取得するメソッド
                // count()メソッドを使って、いいねをしたユーザの数を取得
                // その数を$totalFavoritesに加算していく
                $totalFavorites += $movie->favoriteUsers()->count();
            }
            // $user->movies->last();はUserモデルに記述したmovies()関数を使い、
            // ユーザが所有している動画情報のうち最も最近登録された動画のみを取得
            $movie = $user->movies->last();
        @endphp
        {{-- 3人ごとに改行を入れる --}}
        {{-- $loop->iterationはforeachのループの回数を表す変数 --}}
        {{-- iteration % 3 === 1は、1人目、4人目、7人目...の時にtrueになる --}}
        {{-- $loop->iteration !== 1は、1人目の時は改行しない --}}
        {{-- 4人目、7人目、10人目...の時は改行しない --}}
        @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
            </div>
            <div class="row text-center mt-3">
        @endif
            <div class="col-lg-4 mb-5">
                <div class="movie text-left d-inline-block">
                    <div class="text-right">
                        {{-- ユーザが所有している動画のうち、最新の動画のいいね数を表示 --}}
                        {{-- $movie->favorites_countは、動画のいいね数を表すプロパティ --}}
                        {{-- もし動画がなければ、0を表示 --}}
                        <span class="badge badge-pill badge-success">{{ $totalFavorites }} いいね!</span>
                    </div>
                    {{-- ユーザの名前を表示 --}}
                    {{-- route('user.show', $user->id)は、ユーザの詳細ページへのリンク --}}
                    {{-- ＠マークは、ユーザ名の前に付けて、Twitterのような表記にする --}}
                    <a href="{{ route('user.show', $user->id) }}">＠{{ $user->name }}</a>
                    <div>
                        {{-- <iframe>という画面に「Webページや動画を埋め込む」タグを使って、YouTube動画IDを変数としてURLの中に入れ込むことで、動画を表示させる --}}
                        @if ($movie)
                            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
                        {{-- もし動画がなければ、空のiframeを表示 --}}
                        @else
                            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                        @endif
                    </div>
                        @if (isset($movie->title))
                                </div>
                                <p><a href="{{ route('movie.show', $movie->id) }}">{{ $movie->title }}</a></p>
                                <div>
                        @endif
                </div>
            </div>
    @endforeach
</div>

{{-- ページ送り機能の次ページリンクをこの部分に挿入する --}}
{{-- $usersは、UserControllerでpaginate()メソッドを使ってページネーションを設定した変数 --}}
{{ $users->links('pagination::bootstrap-4') }}
