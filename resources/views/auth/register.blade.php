@extends('layouts.app')
@section('content')
    <div class="text-center">
        <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ×コミュニケーション</h1>
    </div>
    <div class="text-center mt-3">
        <p class="text-left d-inline-block">新規ユーザ登録すると、<br>あなたのチャンネル作成／動画登録等ができるようになります。</p>
    </div>
    <div class="text-center">
        <h3 class="login_title text-left d-inline-block mt-5">新規ユーザー登録</h3>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-6 offset-sm-3">
            <form method="POST" action="{{ route('signup.post') }}">
                @csrf
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control"
                        value="{{ old('password') }}">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">パスワード確認</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        value="{{ old('password_confirmation') }}">
                </div>
                <button type="submit" class="btn btn-primary mt-2">新規登録</button>
            </form>
        </div>
    </div>
@endsection
