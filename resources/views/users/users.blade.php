<div class="main" style="display: flex; justify-content: space-between;"> <!-- 追記 -->
    <div class="contents1"> <!-- 追記 -->
        <h2 class="mt-5 mb-5">ユーザ一覧</h2>
        <!-- <div class="movies row mt-5 text-center"> 15行目に移動-->
    </div>
<!-- 追記ここから -->
    <div class="contents2">
        <div class="input-group" style="position: relative; top: 50px;">
            <form action="{{ route('user.index') }}" style="display: flex; justify-content: right;">
            @csrf
            <input type="search" class="form-control rounded" name="search" value="{{ request('search') }}"placeholder="キーワードを入力" aria-label="検索..." aria-describedby="search-addon">
            <!-- <input type="submit" value="検索" class="btn btn-info"> どちらか消す -->
            <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init >➤</button>
            </form>
        </div>
    </div>
</div>
<!-- 追記ここまで -->
    <div class="movies row mt-5 text-center"> <!-- 4行目から移動 -->
    @foreach ($users as $user)
        @php
            $movies = $user->movies()->get();
            $totalFavorites = 0;
            foreach ($movies as $movie){
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
                        <span class="badge badge-pill badge-success">{{ $totalFavorites }} いいね!</span>
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
</div>
{{ $users->links('pagination::bootstrap-4') }}