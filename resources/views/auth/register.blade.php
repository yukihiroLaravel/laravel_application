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
      {{-- 'signup.post'のルーティングに新規登録ボタンが押されたら、遷移(せんい)する --}}
      {{--遷移するまでは分かるが、route('signup.post')にいったら、今度Register Controllerにいくと思うのだが
      そこから、viewに返ってくる「return view」の記述がない。
      なぜ？？ --}}

      @csrf
      {{-- POSTメソッド実行の時によく使われる ハッキングの手口から守るために必須 外部のサイトから新規登録をされないようにするため 新規登録はこのサイトからのみにするための設定
       このサーバー上以外からは受け付けないよ、という記述 --}}

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
        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
      </div>
      <div class="form-group">
        <label for="password_confirmation">パスワード確認</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
      </div>
      <button type="submit" class="btn btn-primary mt-2">新規登録</button>
      {{-- 新規登録ボタンのtypeを"submit"にすることによって、押された
        瞬間にpostリクエストが飛びますよ、ということ--}}

    </form>
  </div>
</div>
@endsection