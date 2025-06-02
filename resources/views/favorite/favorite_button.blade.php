{{-- -- ユーザがログインしていて、動画の投稿者ではなく、動画がいいね可能な場合 --}}
{{-- この部分は、動画の詳細ページや一覧ページで、動画に対するいいね！ボタンを表示するためのコードです --}}
{{-- 動画の投稿者以外のユーザがいいね！ボタンを押すことができます --}}
{{-- 動画の投稿者は自分の動画に対していいね！を押すことができないため、ボタンは表示されません --}}
{{-- 動画が公開されている場合にのみ、いいね！ボタンが表示されます --}}
{{-- 動画の公開状態は$movie->favorite_flagでチェックします --}}
{{-- ユーザがログインしているかどうかはAuth::check()で確認します --}}
{{-- 動画の投稿者のIDは$movie->user_idで取得できます --}}
@if (Auth::check() && Auth::id() !== $movie->user_id && $movie->favorite_flag)
    {{-- favorite_flagがtrueで、いいね表示の許可が出ている場合 --}}
    {{-- かつ、ユーザがログインしていて、動画の投稿者ではない場合にいいね！ボタンを表示 --}}
    {{-- 動画の投稿者以外のユーザがいいね！ボタンを押すことができます --}}
    
    {{-- いいね！ボタンの表示 --}}
    {{-- ユーザがすでにこの動画をいいねしているかどうかをチェック --}}
    {{-- いいね！ボタンのフォームはPOSTメソッドで、ルートはfavoriteとunfavoriteを使用 --}}
    {{-- いいね！ボタンの表示は、動画の投稿者以外のユーザにのみ表示される --}}
    
    @if (Auth::user()->isFavorite($movie->id))
        <form method="POST" action="{{ route('unfavorite', $movie->id) }}">
            {{-- CSRFトークンを含めるために@csrfディレクティブを使用 --}}
            @csrf
             {{-- いいね！を外す場合はDELETEメソッドを使用し、@method('DELETE')ディレクティブを使用 --}}
            @method('DELETE')
            {{-- いいね！している場合は「いいね！を外す」ボタンを表示 --}}
             {{-- ボタンのスタイルはBootstrapのbtnクラスを使用して、色分け --}}
            <button type="submit" class="btn btn-danger">いいね！を外す</button>
        </form>
    @else
        <form method="POST" action="{{ route('favorite', $movie->id) }}">
            {{-- CSRFトークンを含めるために@csrfディレクティブを使用 --}}
            @csrf
            {{-- いいね！していない場合は「いいね！を押す」ボタンを表示 --}}
             {{-- ボタンのスタイルはBootstrapのbtnクラスを使用して、色分け --}}
            <button type="submit" class="btn btn-success">いいね！を押す</button>
        </form>
    @endif
@endif