<div class="movies row mt-5 text-center">
    @foreach ($movies as $movie)
        @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
            </div>
            <div class="row text-center mt-3">
        @endif
            <div class="col-lg-4 mb-5">
                <div class="movie text-left d-inline-block">
                    @php
                        // 動画がいいねされている場合は動画情報を取得
                        $countFavoriteUsers = $movie->favoriteUsers()->count();
                    @endphp
                    <div class="text-right mb-2">いいね！
                        <span class="badge badge-pill badge-success">{{ $countFavoriteUsers }}</span>                    
                    <div>
                        @if ($movie)
                            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
                        @else
                            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                        @endif
                    </div>
                    <p>
                        @if (isset($movie->title))
                            {{-- 動画のタイトルが存在する場合はタイトルを表示 --}}
                            {{-- 動画のタイトルが存在しない場合は、YouTube動画IDを表示 --}}
                            {{ $movie->title }}
                        @endif
                    </p>
                    {{--viewのfavorite_buttonに、@foreach ($movies as $movie)で取り出した動画の情報を渡す --}}
                    @include('favorite.favorite_button', ['movie' => $movie])
                    {{-- 動画を登録したユーザの名前を表示 --}}
                    {{-- コントローラと同じく、Viewでも @if を用いて、ユーザIDが一致するユーザしかボタンを表示させないように条件分岐 --}}
                    @if (Auth::id() === $movie->user_id)
                        <div class="d-flex justify-content-between">
                             {{-- 動画の削除ボタンと編集ボタンを表示 --}}
                             {{-- 動画の削除ボタンは、POSTメソッドで、ルートはmovie.deleteを使用 --}}
                             {{-- CSRFトークンを含めるために@csrfディレクティブを使用 --}}
                             {{-- 削除ボタンは赤色、編集ボタンは青色 --}}
                             <form method="POST" action="{{ route('movie.delete', $movie->id) }}">
                             @csrf
                             {{-- DELETEメソッドを使用するために@method('DELETE')ディレクティブを使用 --}}
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
{{-- ページ送り機能の次ページリンクをこの部分に挿入する --}}
{{-- $moviesはコントローラから受け取ったページネーション済みの動画情報 --}}
{{-- pagination::bootstrap-4 は、Bootstrap 4用のページネーションビューを指定 --}}
{{ $movies->links('pagination::bootstrap-4') }}
