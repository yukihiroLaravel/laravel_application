{{-- mb-5はBootstrapのクラス --}}
<header class="mb-5">
    {{-- Bootstrapのナビゲーションバーを使用 --}}
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">YouTubeまとめ<br>&ensp;×コミュニケーション</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- ナビゲーションバーの中身 --}}
        {{-- collapseクラスはBootstrapのクラスで、ナビゲーションバーの表示・非表示を切り替える --}}
        {{-- id属性はBootstrapのJavaScriptで使用されるため、必ず指定する必要がある --}}
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="" class="nav-link">新規ユーザ登録</a></li>
                <li class="nav-item"><a href="" class="nav-link">ログイン</a></li>
            </ul>
        </div>
    </nav>
</header>
