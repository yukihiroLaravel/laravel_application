@if (Auth::check() && Auth::id() !== $movie->user_id && $movie->favorite_flag)
    @if (Auth::user()->isFavorite($movie->id))
        <form action="{{ route('unfavorite', $movie->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">いいね！を外す</button>
        </form>
    @else
        <form action="{{ route('favorite', $movie->id) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success">いいね！を押す</button>
        </form>
    @endif
@endif
