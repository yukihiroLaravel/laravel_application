@extends('layouts.app')
@section('content')
    <h2 class="mt-5">検索画面</h2>
    <form method="POST" action="{{ route('search.search') }}">
        @csrf

        <div>
                <label for="title" class="mt-3">動画タイトル</label></div>
        <div class="input-group">
            <div class="form-outline">
                <input id="search-input" type="search" id="form1" class="form-control"  name="keyword" value="{{ old('title') }}">
        </div>
            <span>
                <button id="search-button" type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </span>
        </div>

        <!-- <div class="form-group mt-5">
            <div class="form-group">
            <div class="form-group">
                <label for="title" class="mt-3">動画タイトル</label>

                    <div class="input-group">
                        <div class="form-outline">
                            <input type="search" id="form1" class="form-control" />
                            <label class="form-label" for="form1">Search</label>
                        </div>
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                <input id="keyword" type="text" class="form-control" name="keyword" value="{{ old('title') }}">
            </div>
            <button type="submit" class="btn btn-primary mt-5 mb-5">検索する</button>
        </div> -->
    </form>
    <div class="movies row mt-5 text-center">
    <h4>検索結果</h4>
    <div class="container">
        @foreach ($movies as $movie)
            <div class="container text-left">{{ $movie->title }}</div>
        @endforeach
        <!-- <ul class="navbar-nav text-left">
            @foreach ($movies as $movie)
                <li>{{ $movie->title }}</li>
            @endforeach
        </ul> -->
    </div>
</div>
@endsection