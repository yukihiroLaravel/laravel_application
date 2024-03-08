@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-primary">
            {{ session('status') }}
        </div>
    @endif
    <h1 class="d-flex align-items-center">
        <img src="{{ asset('storage/images' . Auth::user()->icon) }}" alt="user-icon" class="user-page-icon mr-1">
        {{ $user->name }}
    </h1>
    <ul class="nav nav-tabs nav-justified mt-5 mb-2">
        <li class="nav-item nav-link {{ Request::routeIs('user.show') ? 'active' : '' }}">
            <a href="{{ route('user.show', $user->id) }}">
                動画<br>
                <div class="badge badge-secondary">{{ $countMovies }}</div>
            </a>
        </li>
        <li class="nav-item nav-link {{ Request::routeIs('user.favorites') ? 'active' : '' }}">
            <a href="{{ route('user.favorites', $user->id) }}">
                お気に入り<br>
                <div class="badge badge-secondary">{{ $countFavorites }}</div>
            </a>
        </li>
    </ul>
    @include('movies.movies', ['user' => $user, 'movies' => $movies])
@endsection
