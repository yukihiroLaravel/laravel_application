@extends('layouts.app')
@section('content')

@if (session('status'))
    <div style="max-width: 400px; margin: 0 auto; padding: 10px; border: 1px solid #28a745; background-color: #dfffd6; border-radius: 5px; color: #155724; margin-bottom: 20px; text-align: center;">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.update') }}" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div style="margin-bottom: 20px;">
        <label for="email" style="display: block; font-size: 1.2em; font-weight: bold; margin-bottom: 5px;">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
               style="width: 100%; padding: 10px; font-size: 1em; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
        @error('email')
        <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom: 20px;">
        <label for="password" style="display: block; font-size: 1.2em; font-weight: bold; margin-bottom: 5px;">新しいパスワード</label>
        <input id="password" type="password" name="password" required
               style="width: 100%; padding: 10px; font-size: 1em; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
        @error('password')
        <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom: 20px;">
        <label for="password_confirmation" style="display: block; font-size: 1.2em; font-weight: bold; margin-bottom: 5px;">パスワード確認</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
               style="width: 100%; padding: 10px; font-size: 1em; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
        @error('password_confirmation')
        <div style="color: red; font-size: 0.9em; margin-top: 5px;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" style="width: 100%; padding: 10px; font-size: 1.2em; color: #fff; background-color: #007bff; border: none; border-radius: 5px; cursor: pointer;">
        パスワードをリセット
    </button>
</form>

</form>
@endsection