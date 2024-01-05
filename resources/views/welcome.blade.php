@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-dark">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ</h1>
            <h1>× コミュニケーション</h1>
        </div>
    </div>

    <h5 class="description text-center">みんなの"オススメ"動画を自由にシェアしよう</h5>

    <form method="POST" action="{{ route('index.switching') }}#index" class="anchor" id="index">
        @csrf
        <ul class="nav nav-tabs nav-justified mt-5">
            <li class="nav-item nav-link {{ isset($movies) ? 'active' : '' }}">
                <button type="submit" class="top-tab" name="index_movie">動画一覧</button>
            </li>
            <li class="nav-item nav-link {{ isset($users) ? 'active' : '' }}">
                <button type="submit" class="top-tab" name="index_user">チャンネル一覧</button>

            </li>
        </ul>
    </form>

    <form method="GET" action="{{ route('index.search') }}#index">
        <div class="input-group col-5 mx-auto mt-5 mb-5">
            <input type="text" name="search_word" id="search_word" value="{{ isset($search_word) ? $search_word : '' }}"
                class="form-control input-group-prepend"
                placeholder="{{ isset($movies) ? '動画' : '' }}{{ isset($users) ? 'チャンネル' : '' }}を検索する">
            <span class="input-group-btn input-group-append">
                <button type="submit" id="btn-search" class="btn btn-primary"
                    name="{{ isset($movies) ? 'movie_search' : '' }}{{ isset($users) ? 'user_search' : '' }}"><i
                        class="fas fa-search"></i></button>
            </span>
        </div>
    </form>

    @if (isset($movies))
        @include('index.movie', ['movies' => $movies])
        {{ $movies->appends(request()->query())->links() }}
    @elseif(isset($users))
        @include('index.users', ['users' => $users])
        {{ $users->appends(request()->query())->links() }}
    @endif
@endsection
