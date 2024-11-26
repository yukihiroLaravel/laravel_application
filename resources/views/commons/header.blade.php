<header class="mb-5">
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <!-- navbar-expandでハンバーガーメニューを開いた時の処理-->

    <a class="navbar-brand" href="/">YouTubeまとめ<br>&ensp;×コミュニケーション</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- 画面幅が小さい場合は上記が表示される ハンバーガーメニュー -->

    <div class="collapse navbar-collapse" id="nav-bar">

      <ul class="navbar-nav mr-auto"></ul>
      <ul class="navbar-nav">
        <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">新規ユーザ登録</a></li>
        <li class="nav-item"><a href="" class="nav-link">ログイン</a></li>
      </ul>
      <!-- 画面幅が大きい場合は上記が表示される -->

    </div>
  </nav>
</header>