@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-dark">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ</h1>
            <h1>× コミュニケーション</h1>
        </div>
    </div>

    <h5 class="description text-center mb-5">みんなの"オススメ"動画を自由にシェアしよう</h5>

    <div class="nav nav-tabs nav-justified anchor" id="index">
        <form method="GET" action="{{ route('movies.list') }}#index"
            class="nav-item nav-link {{ isset($movies) ? 'active' : '' }}">
            @csrf
            <div>
                <button type="submit" class="top-tab" name="index_movie">動画一覧</button>
            </div>
        </form>
        <form method="GET" action="{{ route('users.list') }}#index"
            class="nav-item nav-link {{ isset($users) ? 'active' : '' }}">
            <div>
                <button type="submit" class="top-tab" name="index_user">チャンネル一覧</button>

            </div>
        </form>
    </div>
    @if (isset($movies))
        <form method="GET" action="{{ route('movies.list') }}#index" class="input-group col-5 mx-auto mt-5 mb-5">
    @endif
    @if (isset($users))
        <form method="GET" action="{{ route('users.list') }}#index" class="input-group col-5 mx-auto mt-5 mb-5">
    @endif




    <input type="text" name="search_word" value="{{ isset($search_word) ? $search_word : '' }}"
        class="form-control input-group-prepend"
        placeholder="{{ isset($movies) ? '動画' : '' }}{{ isset($users) ? 'チャンネル' : '' }}を検索する">
    <span class="input-group-btn input-group-append">
        <button type="submit" id="btn-search" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </span>
    </form>


    @if (isset($movies))
        @include('index.movie', ['movies' => $movies])
        @if (isset($search_word))
            {{ $movies->appends(['search_word' => $search_word])->fragment('index')->links() }}
        @else
            {{ $movies->fragment('index')->links() }}
        @endif
    @elseif(isset($users))
        @include('index.users', ['users' => $users])
        @if (isset($search_word))
            {{ $users->appends(['search_word' => $search_word])->fragment('index')->links() }}
        @else
            {{ $users->fragment('index')->links() }}
        @endif
    @endif
@endsection
