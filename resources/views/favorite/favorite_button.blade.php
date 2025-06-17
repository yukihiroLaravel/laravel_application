{{-- いいね！ボタンの表示 --}}

{{-- ユーザがログインしていて、動画の投稿者でない場合に、いいね！ボタンを表示 --}}
{{-- $movie->user_idは、動画の投稿者のユーザID --}}
{{-- Auth::check()は、ユーザがログインしているかどうかを確認するメソッド --}}
@if (Auth::check() && Auth::id() !== $movie->user_id)

    {{-- ログインしているユーザーが特定の動画をすでにいいねしているか確認する --}}
    {{-- もし、いいねしていれば、「いいねを外す」ボタンを表示する--}}
    {{-- Auth::id()は、現在ログインしているユーザのIDを取得するメソッド --}}
    @if (Auth::user()->isFavorite($movie->id))
        <form method="POST" action="{{ route('unfavorite', $movie->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">いいね！を外す</button>
        </form>
    {{-- いいねしていなければ、「いいね！を押す」ボタンを表示する --}}
    @else
        <form method="POST" action="{{ route('favorite', $movie->id) }}">
            @csrf
            <button type="submit" class="btn btn-success">いいね！を押す</button>
        </form>
    @endif
@endif





