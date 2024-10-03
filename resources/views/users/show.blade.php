<!--ユーザーの詳細画面-->
@extends('layouts.app')
@section('content')
    <h1>{{ $user->name }}</h1>
    <ul class="nav nav-tabs nav-justified mt-5 mb-2">
        <li class="nav-item nav-link {{ Request::is('users/'. $user->id) ? 'active' : '' }}"><!-- リクエストパスがusers/で始まるかどうかチェックする。始まる場合active、そうでない場合''-->
            <a href="{{ route('user.show',$user->id) }}"><!--user.showルートにuser->idを渡す。-->
                動画<br>
                <div class="badge badge-secondary">{{ $countMovies }}</div>
            </a>
        </li>

        <li class="nav-item nav-link {{ Request::is('users/'.$user->id.'favorites') ? 'active' : ''}}">
            <a href="{{ route('user.favorites',$user->id)}}">
                お気に入り<br>
                <div class="badge badge-secondary">{{ $countFavorites }}</div>
            </a>
        </li>
    </ul>
    @include('movies.movies', ['user' => $user, 'movies' => $movies])
@endsection