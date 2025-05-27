{{-- -- ユーザがログインしていて、動画の投稿者ではなく、動画がいいね可能な場合 --}}
@if (Auth::check() && Auth::id() !== $movie->user_id && $movie->favorite_flag)
    
    {{-- いいね！ボタンの表示 --}}
    {{-- ユーザがすでにこの動画をいいねしているかどうかをチェック --}}
    {{-- いいね！している場合は「いいね！を外す」ボタンを表示 --}}
    {{-- いいね！していない場合は「いいね！を押す」ボタンを表示 --}}
    {{-- いいね！ボタンのフォームはPOSTメソッドで、ルートはfavoriteとunfavoriteを使用 --}}
    {{-- CSRFトークンを含めるために@csrfディレクティブを使用 --}}
    {{-- いいね！を外す場合はDELETEメソッドを使用し、@method('DELETE')ディレクティブを使用 --}}
    {{-- ボタンのスタイルはBootstrapのbtnクラスを使用して、色分け --}}
    {{-- いいね！を押すボタンは緑色、いいね！を外すボタンは赤色 --}}
    {{-- いいね！ボタンの表示は、動画の投稿者以外のユーザにのみ表示される --}}
    
    @if (Auth::user()->isFavorite($movie->id))
        <form method="POST" action="{{ route('unfavorite', $movie->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">いいね！を外す</button>
        </form>
    @else
        <form method="POST" action="{{ route('favorite', $movie->id) }}">
            @csrf
            <button type="submit" class="btn btn-success">いいね！を押す</button>
        </form>
    @endif
@endif