@if (Auth::check() && Auth::id() !== $movie->user_id && $movie->favorite_flag) <!--ユーザーがログインしているかつ、ユーザーidと動画のユーザーidが一致しない場合を表している。つまり自分の動画ではない場合ということ。 -->
    @if (Auth::user()->isFavorite($movie->id))<!-- ログインしているユーザーがすでにいいねしている場合を表している。-->
        <form method="post" action="{{ route('unfavorite',$movie->id)}}" >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">いいね！を外す</button>
        </form>
    @else 
        <form method="POST" action="{{ route('favorite',$movie->id)}}">
            @csrf
            <button type="submit" class="btn btn-success">いいね！を押す</button>
        </form>
    @endif
@endif