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
        <li class="nav-item nav-link><a href="">お気に入り<br><div class="badge badge-secondary"></div></a></li>
    </ul>
    @include('movies.movies', ['user' => $user, 'movies' => $movies])
@endsection
