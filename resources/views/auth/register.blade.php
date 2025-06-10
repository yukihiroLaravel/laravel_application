{{-- 
 * 新規ユーザ登録画面
 * このファイルは、ユーザが新規登録を行うためのフォームを表示するためのBladeテンプレートです。
 * ユーザが名前、メールアドレス、パスワードを入力し、新規登録を行うことができます。
 --}}
{{-- @extendsなので、register.blade.phpは、app.blade.phpを継承している --}}
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
            {{-- commonsディレクトリ内のerror_messages.blade.phpを表示 --}}
            @include('commons.error_messages')
            {{-- 新規登録フォーム --}}
            {{-- POSTメソッド（新規登録ボタンを押す）で、ルーティングのsignup.postにデータを送信 --}}
            {{-- route('signup.post')は、web.phpで定義されたルートの名前を参照 --}}
            <form method="POST" action="{{ route('signup.post') }}">
                {{-- csrfトークンを含めることで、セキュリティを強化 --}}
                {{-- CSRF（クロスサイトリクエストフォージェリ）攻撃を防ぐためのトークン --}}
                @csrf
                <div class="form-group">
                    <label for="name">名前</label>
                    {{-- ユーザが入力した名前を保持するために、old('name')を使用 --}}
                    {{-- old('name')は、バリデーションエラーが発生した場合に、入力値を保持するためのヘルパー関数 --}}
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
                </div>
                <div class="form-group">
                    {{-- パスワード確認のための入力フィールド --}}
                    <label for="password_confirmation">パスワード確認</label>
                    {{-- パスワード確認の入力フィールド --}}
                    {{-- ユーザが入力したパスワード確認を保持するために、old('password_confirmation')を使用 --}}
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                </div>
                {{-- 新規登録ボタン --}}
                <button type="submit" class="btn btn-primary mt-2">新規登録</button>
            </form>
        </div>
    </div>
@endsection
