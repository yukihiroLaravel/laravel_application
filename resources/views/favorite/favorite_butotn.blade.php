@if (Auth::check() && Auth::id() !== $movie->user_id && $movie->favorite_flag)
<!-- ユーザーがログインしているか確認-->
<!-- ユーザーidとmovieテーブルのidが違うかを確認 動画投稿者idと異なるか確認 -->
<!-- movieテーブルのfavorite_flagの状態を確認 対象ユーザーがお気に入り可能か確認（投稿主はお気に入り不可） -->
@if (Auth::user()->isFavorite($movie->id))
<!-- ユーザーがログイン状態でお気に入り登録していたか確認(movieテーブルのidから参照) -->
<form method="POST" action="{{ route('unfavorite', $movie->id) }}">
    @csrf
    <!-- csrfトークンを生成,セキュリティ保護 -->
    <!-- クロスサイトリクエストフォージェリ -->
    <!-- 不正リクエストを防止する laravelでフォームタグを使用する際はセットで使用 -->
    @method('DELETE')
    <!-- deleteメソッド -->
    <button type="submit" class="btn btn-danger">いいね！を外す</button>
</form>
@else
<form method="POST" action="{{ route('favorite', $movie->id) }}">
    @csrf
    <button type="submit" class="btn btn-success">いいね！を押す</button>
</form>
@endif
@endif