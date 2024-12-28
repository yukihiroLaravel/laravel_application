@extends('layouts.app')
@section('content')
<h1 style="text-align: center;">検索結果</h1>


@if ($movies->isNotEmpty())
@include('movies.movies')
    <!-- {{ $movies->links() }} ページネーションリンク -->
@else
    <p>検索結果が見つかりませんでした。</p>
@endif
@endsection