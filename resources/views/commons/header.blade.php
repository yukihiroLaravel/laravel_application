<!-- 文書やウェブページの上部に表示される領域のviewファイル -->

<header class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">YouTubeまとめ<br>&ensp;×コミュニケーション</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <!-- 新規ユーザー登録を押したときに、新規登録画面の表示のルーティングが実行される。-->
                <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">新規ユーザ登録</a></li>
                <li class="nav-item"><a href="" class="nav-link">ログイン</a></li>
            </ul>
        </div>
    </nav>
</header>