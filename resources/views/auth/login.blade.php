@extends('layouts.app')
@section('content')
<div class="text-center">
  <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ×コミュニケーション</h1>
</div>
<div class="text-center mt-3">
  <p class="text-left d-inline-block">ログインすると、<br>あなたのチャンネル作成／動画登録等ができるようになります。</p>
</div>
<div class="text-center">
  <h3 class="login_title text-left d-inline-block mt-5">ログイン</h3>
</div>
<div class="row mt-5 mb-5">
  <div class="col-sm-6 offset-sm-3">
    <form method="POST" action="{{ route('login.post') }}">
      {{-- ログインボタンが押されたら、'login.post'のルーティングに遷移(せんい)する   --}}

      @csrf
      {{-- POSTメソッド実行の時によく使われる ハッキングの手口から守るために必須 外部のサイトから新規登録をされないようにするため 新規登録はこのサイトからのみにするための設定
        このサーバー上以外からは受け付けないよ、という記述 --}}

      <div class="form-group">
        <label for="email">メールアドレス</label>
        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
      </div>
      <div class="form-group">
        <label for="password">パスワード</label>
        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
      </div>
      <button type="submit" class="btn btn-primary mt-2">ログイン</button>
    </form>
    <div class="mt-2"><a href="{{ route('signup') }}">新規ユーザ登録する？</a></div>
  </div>
</div>
@endsection