@extends('layouts.app')

@section('content')
<div class="container">
    <h2>パスワード変更</h2>
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="current_password">現在のパスワード</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
            @error('current_password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="new_password">新しいパスワード</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
            @error('new_password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="new_password_confirmation">新しいパスワード（確認）</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">変更</button>
    </form>
</div>
@endsection
