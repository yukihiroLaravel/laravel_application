@if (Auth::check() && Auth::id() !== $movie->user_id && $movie->favorite_flag)
    @if (Auth::user()->isFavorite($movie->id))
        <form method="POST" action="{{ route('unfavorite', $movie->id) }}" class="d-flex">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary favorite_btn">
                <i class="fa fa-thumbs-up mr-1" aria-hidden="true"></i>
                はずす
            </button>
        </form>
    @else
        <form method="POST" action="{{ route('favorite', $movie->id) }}">
            @csrf
            <button type="submit" class="btn btn-success favorite_btn">
                <i class="fa fa-thumbs-up mr-1" aria-hidden="true"></i>
                いいね！
            </button>
        </form>
    @endif
@endif
