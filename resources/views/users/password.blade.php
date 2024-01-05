@extends('layouts.app')
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="text-center">
        <h3 class="login_title text-left d-inline-block mt-5">パスワード変更</h3>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-6 offset-sm-3">
            <form method="POST" action="{{ route('password.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="current_password">現在のパスワード</label>
                    <input id="current_password" type="text" class="form-control" name="current_password"
                        value="{{ old('current_password') }}">
                </div>


                <div class="form-group">
                    <label for="password">新しいパスワード</label>
                    <input id="password" type="password" class="form-control" name="password" value="">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">パスワード確認</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        value="">
                </div>

                <button type="submit" class="btn btn-primary mt-4">変更を保存する</button>
            </form>
        </div>
    </div>
@endsection
