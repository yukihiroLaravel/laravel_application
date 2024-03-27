@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-dark">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTube Summary</h1>
            <h1>×Communication</h1>
        </div>
    </div>
    <h5 class="descriptiopn text-center"> Let's shear your reccomend movie!!</h5>
    @include('users.users', ['users' => $users])
@endsection