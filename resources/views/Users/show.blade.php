@extends('layouts.app')
@section('content')
    <h1>{{ $user->name }}{{ $user->email_verified_at ? '✅認証' : '（未認証）' }}</h1>
@include('components.userTab')
    @include('movies.movies', ['user' => $user, 'movies' => $movies])
@endsection