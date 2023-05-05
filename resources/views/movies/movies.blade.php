<div class="movies row mt-5 text-center">
    @foreach ($movies as $movie)
        @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
        </div>
        <div class="row text-center mt-3">
        @endif
        <div class="col-lg-4 mb-5">
            <div class="movie text-left d-inline-block">
                @php
                    $countFavoriteUsers = $movie->favoriteUsers()->count();
                @endphp
                <div class="text-right mb-2">いいね！
                    <span class="badge badge-pill badge-success">{{ $countFavoriteUsers }}</span>
                </div>
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
                    @include('favorite.favorite_button', ['movie' => $movie])
                    @if (Auth::id() === $movie->user_id)
                    <div class="d-flex justify-content-between">
                        <form method="POST" action="{{ route('movie.delete', $movie->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">この動画を削除する</button>
                        </form>
                        <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary">編集する</a>
                    </div>
                    @endif
                <div class="line-height my-3">
                    <div id="comment-article-{{ $movie->id }}">
                        @include('movies.comment_list')
                    </div>
                    <div class="">
                        <form method="POST" action="{{ route('comment.store') }}" accept-charset="UTF-8" data-remote="true"><input name="utf8" type="hidden" value="&#x2713;" />
                            @csrf
                            <div class="form-group">
                                <input value="{{ $movie->id }}" type="hidden" name="movie_id" />
                                <input value="{{ Auth::id() }}" type="hidden" name="user_id" />
                                <textarea id="comment" class="form-control" placeholder="コメント ..." autocomplete="off" name="comment" value="{{ old('comment') }}" cols="50" rows="2"></textarea>
                                <button type="button" onclick="submit();" class="btn btn-info mt-1 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    </svg> コメントする
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $movies->links('pagination::bootstrap-4') }}