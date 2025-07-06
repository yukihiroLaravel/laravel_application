@extends('layouts.app')
@section('content')
    <h1>{{ $user->name }}</h1>
    <ul class="nav nav-tabs nav-justified mt-5 mb-2">
        {{-- {{ Request::is(‘users/’ . $user->id) ? ‘active’ : ” }}というのは、--}}
        {{-- 現在のURLが/users/{id} というアドレスにアクセスされたらclassに、”active” という文字を追加する意味があります。 --}}
        {{-- class=”active” にするとBootstrapが「今開いているタブ」だと判断して、そのタブを強調して表示してくれます。--}}

        {{-- つまり、現在のURLが/users/{id}にアクセスされている場合、--}}
        {{-- class="active"を追加して、そのタブを強調表示するということです。 --}}
        {{-- Request::is()は、現在のリクエストのパスが指定されたパターンと一致するかどうかを確認するメソッドです。 --}}
        {{-- ここでは、ユーザのIDに基づいて、現在のページがそのユーザのページであるかどうかを確認しています。 --}}
        
        <li class="nav-item nav-link {{ Request::is('users/'. $user->id) ? 'active' : '' }}"><a href="{{ route('user.show', $user->id) }}">動 画<br><div class="badge badge-secondary">{{ $countMovies }}</div></a></li>
        {{-- 動画の数を表示するために、$countMovies変数を使用 --}}
        {{-- $countMoviesは、コントローラで計算された動画の数です --}}
        <li class="nav-item nav-link {{ Request::is('users/'. $user->id. '/favorites') ? 'active' : '' }}"><a href="{{ route('user.favorites', $user->id) }}">お気に入り<br><div class="badge badge-secondary">{{ $countFavorites }}</div></a></li>
    </ul>
    {{-- ユーザが所有している動画のうち、最新の動画を表示 --}}
    {{-- もし動画がなければ、空のiframeを表示 --}}
    @include('movies.movies', ['user' => $user, 'movies' => $movies])
@endsection
