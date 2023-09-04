@extends('layouts.app')
@section('content')
    <h2 class="mt-5">検索画面</h2>
    <form method="POST" action="{{ route('search.search') }}">
        @csrf
        <div class="form-group mt-5">
            <div class="form-group">
            <div class="form-group">
                <label for="title" class="mt-3">動画タイトル</label>
                <input id="keyword" type="text" class="form-control" name="keyword" value="{{ old('title') }}">
            </div>
            <button type="submit" class="btn btn-primary mt-5 mb-5">検索する</button>
        </div>
    </form>
@endsection