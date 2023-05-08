@if (Auth::check() && Auth::id() !== $movie->user_id && $movie->favorite_flag)
@if (Auth::user()->isFavorite($movie->id))
<form method="POST" action="{{ route('unfavorite', $movie->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x-fill"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
        </svg> いいね！を外す
    </button>
</form>
@else
<form method="POST" action="{{ route('favorite', $movie->id) }}">
    @csrf
    <button type="submit" class="btn btn-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-heart"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z" />
        </svg> いいね！を押す
    </button>
</form>
@endif
@endif