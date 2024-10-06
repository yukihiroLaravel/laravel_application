<h2 class="mt-5 mb-5">チャンネル一覧</h2>
<div class="d-flex justify-content-center mt-5">
    <form class="w-50" method="GET" action="{{ route('users.search') }}">
        @csrf
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="ユーザー名で検索">
            <button class="btn btn-primary" type="submit">検索</button>
        </div>
    </form>
</div>
<div class="movies row mt-5 text-center">
    @if(isset($users))
        @foreach ($users as $user)
            @php
                $movies = $user->movies()->get();
                $totalFavorites = 0;
                foreach($movies as $movie){
                    $totalFavorites += $movie->favoriteUsers()->count();
                }
                $movie = $user->movies->last();
            @endphp
            @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
                </div>
                <div class="row text-center mt-3">
            @endif
                <div class="col-lg-4 mb-5">
                    <div class="movie text-left d-inline-block">
                        <div class="text-right">
                            <span class="badge badge-pill badge-success">{{ $totalFavorites }} いいね！</span>
                        </div>
                        <a href="{{ route('user.show', $user->id) }}">＠{{ $user->name }}</a>
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
                    </div>
                </div>
        @endforeach
    @endif
</div>
{{ $users->links('pagination::bootstrap-4') }}
