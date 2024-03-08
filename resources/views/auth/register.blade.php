@extends('layouts.app')
@section('content')
    <div class="text-center">
        <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ×コミュニケーション</h1>
    </div>
    <div class="text-center mt-3">
        <p class="text-left d-inline-block">新規ユーザ登録すると、あなたのチャンネル作成／動画登録等ができるようになります。</p>
    </div>
    <div class="text-center">
        <h3 class="login_title text-left d-inline-block mt-5">新規ユーザー登録</h3>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-6 offset-sm-3">
            <form method="POST" action="{{ route('signup.post') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group d-flex flex-column align-items-center">
                    <div class="preview-box mb-2">
                        <img src="{{ asset('storage/images/user_icon_default.png') }}" alt="ユーザーアイコン"
                            id="preview-default_icon" class="preview-icon active">
                        <img src="{{ asset('storage/images/user_icon_default.png') }}" alt="ユーザーアイコン" id="preview-new_icon"
                            class="preview-icon">
                    </div>

                    <p class="d-flex flex-column align-items-center">
                        アイコン画像<br>
                        <span style="font-size: 0.6rem;">（＊任意）</span>
                    </p>
                    <div class="d-flex flex-gap-1">
                        <label class="upload-icon">
                            選択
                            <input type="file" id="user_icon" class="d-none" name="icon" accept=".png, .jpg, .jpeg">
                        </label>
                        <button type="button" id="reset-icon">リセット</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">名前</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input id="password" type="password" class="form-control" name="password"
                        value="{{ old('password') }}">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">パスワード確認</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        value="{{ old('password_confirmation') }}">
                </div>


                <div class="flex items-center mt-4">
                    <button type="submit" class="btn btn-primary mr-3">新規登録</button>
                    <a href="{{ route('login.google') }}" class="btn btn-primary">
                        Googleアカウントで新規登録
                    </a>
                </div>
            </form>



        </div>
    </div>
@endsection
