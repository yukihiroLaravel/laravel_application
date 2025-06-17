<div class="movies row mt-5 text-center">
    @foreach ($movies as $movie)
        @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
            </div>
            <div class="row text-center mt-3">
        @endif
            <div class="col-lg-4 mb-5">
                <div class="movie text-left d-inline-block">

                     <div class="col-lg-4 mb-5">
                <div class="movie text-left d-inline-block">
                    @php
                        // 動画のいいね数を取得
                        // $movie->favoriteUsers()は、動画にいいねをしたユーザの情報を取得するメソッド
                        // count()メソッドを使って、いいねをしたユーザの数を取得
                        // その数を$countFavoriteUsersに格納
                        $countFavoriteUsers = $movie->favoriteUsers()->count();
                    @endphp
                    <div class="text-right mb-2">いいね！
                        <span class="badge badge-pill badge-success">{{ $countFavoriteUsers }}</span>
                    </div>
                    <div>
                        @if ($movie)
                            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
                        @else
                            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                        @endif
                    </div>
                    <p>
                        @if (isset($movie->title))
                            {{ $movie->title }}
                        @endif
                    </p>
                    {{-- includeディレクティブを使用して、favorite_button.blade.phpを読み込む --}}
                    {{-- このファイルは、動画のいいね！ボタンを表示するためのビュー --}}
                    {{-- $movie変数を渡して、動画情報を取得 --}}
                    @include('favorite.favorite_button', ['movie' => $movie])
                    {{--ログインしているユーザーが動画の持ち主のIDと一致しているか確認 --}}
                     @if (Auth::id() === $movie->user_id)
                        {{-- 動画の持ち主であれば、動画の編集と削除ボタンを表示 --}}
                        {{-- movie.deleteは、MovieControllerのdestroyメソッドを呼び出すルート --}}
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

{{-- ファイルの構造は原則、users.blade.php と同じ --}}
{{-- ただし、movies.blade.phpでは、動画一覧を表示するために、$movies変数を使用している --}}
{{-- また、動画登録フォームは、create.blade.phpで定義されているため、ここでは表示しない --}}
{{-- movies.blade.phpは、MovieControllerで取得した動画一覧を表示するためのビュー --}}
{{-- このファイルは、MovieControllerのindexメソッドで使用される --}}