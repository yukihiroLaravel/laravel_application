@extends('layouts.app')

@section('content')
    <div class="center jumbotron bg-dark">
        <div class="text-center text-white mt-2 pt-1">
            <h1 class="matome"><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ</h1>
            <h1 class="matome">× コミュニケーション</h1>
        </div>
    </div>
    <p class="text-right">
        @if(Auth::check())
            ユーザー：<span class="user-name">{{ Auth::user()->name }}</span>
        @endif
    </p>

    <h5 class="description text-center">みんなの"オススメ"動画を自由にシェアしよう</h5>
@endsection
