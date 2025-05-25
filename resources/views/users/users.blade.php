<h2 class="mt-5 mb-5">チャンネル一覧</h2>
<div class="movies row mt-5 text-center">
    {{-- コントローラから受け取った変数「$users」から１人１人のユーザを取り出して繰り返す --}}
    @foreach ($users as $user)
        @php
        // Userモデルに記述したmovies()関数を使い、ユーザが所有している動画情報のうち最も最近登録された動画のみを抜き出し
            $movie = $user->movies->last();
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
                    ＠{{ $user->name }}
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