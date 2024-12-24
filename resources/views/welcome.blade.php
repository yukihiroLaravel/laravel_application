@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-warning">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ</h1>
            <h1>× コミュニケーション</h1>
        </div>
    </div>
    <h5 class="description text-center">みんなの"オススメ"動画を自由にシェアしよう</h5>

     <!-- <form action="{{ route('movies.search') }}" method="GET">
    <input type="text" name="keyword" placeholder="検索キーワード" value="{{ request('keyword') }}">
    <button type="submit">検索</button>
    </form> -->

    <form action="{{ route('movies.search') }}" method="GET" class="text-center">
    <div class="input-group mb-3" style="max-width: 500px; margin: 0 auto;">
        <input 
            type="text" 
            name="keyword" 
            class="form-control" 
            placeholder="検索キーワード" 
            value="{{ request('keyword') }}"
        >
        <button 
            type="submit" 
            class="btn btn-primary"
        >
            検索
        </button>
    </div>
    </form>


    @include('users.users', ['users' => $users])
@endsection