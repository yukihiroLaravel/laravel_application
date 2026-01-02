@extends('layouts.app')
@section('content')
    <h1>{{ $user->name }}</h1>
    <!-- 4-4_ユーザ詳細
    ユーザ詳細画面のViewは、ユーザ名の下に「タブ」を表示させ、
     「ユーザの動画情報一覧」や「いいね！した動画一覧」をタブによって
     切り替えられるようにします。 
     -->
    <ul class="nav nav-tabs nav-justified mt-5 mb-2">
        <li class="nav-item nav-link {{ Request::is('users/'. $user->id) ? 'active' : '' }}"><a href="{{ route('user.show', $user->id) }}">動 画<br><div class="badge badge-secondary">{{ $countMovies }}</div></a></li>
        <li class="nav-item nav-link><a href="">お気に入り<br><div class="badge badge-secondary"></div></a></li>
    </ul>
    @include('movies.movies', ['user' => $user, 'movies' => $movies])
@endsection