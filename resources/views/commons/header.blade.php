<header class="mb-5">
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    {{-- navbar-expandでハンバーガーメニューを開いた時の処理 --}}

    <a class="navbar-brand" href="/">YouTubeまとめ<br>&ensp;×コミュニケーション</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
      <span class="navbar-toggler-icon"></span>
    </button>
    {{-- 画面幅が小さい場合は上記が表示される ハンバーガーメニュー --}}

    <div class="collapse navbar-collapse" id="nav-bar">

      <ul class="navbar-nav mr-auto"></ul>
      <ul class="navbar-nav">

        @if (Auth::check())
        {{--ユーザーがログインしているか判定するメソッドがcheck() --}}
        {{-- Authはファサードと呼ばれるもの クラスを呼び出さなくても使えるクラス Laravelが最初から定義している--}}

        <li class="nav-item"><a href="{{ route('movie.create') }}" class="nav-link">動画登録する</a></li>
        <li class="nav-item"><a href="{{ route('user.show', Auth::id()) }}" class="nav-link">マイページ</a></li>
        <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">ログアウト</a></li>

        @else
        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
        <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">新規ユーザ登録</a></li>
        @endif

      </ul>
      {{-- 画面幅が大きい場合は上記が表示される --}}

    </div>
  </nav>
</header>
@if(Auth::check())
<p class="text-right mr-3 pb-3">
  ユーザー：<span class="user-name">{{ Auth::user()->name }}</span>
</p>
{{-- Auth::user()で、ログインしているユーザーの情報を取得できる --}}

@endif