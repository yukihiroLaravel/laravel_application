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
                <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- Auth::check()は、ユーザがログインしているかどうかを確認するメソッド --}}
                @if (Auth::check())
                    {{-- ログインしている場合のナビゲーションメニュー --}}
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">ログアウト</a></li>
                    <li class="nav-item"><a href="" class="nav-link">マイページ</a></li>
                @else
                    {{-- ログインしていない場合のナビゲーションメニュー --}}
                    {{-- route('login')は、web.phpで定義されたルートの名前を参照 --}}
                    {{-- route('signup')は、新規ユーザ登録のルートを参照 --}}
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
                    <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">新規ユーザ登録</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>
{{-- ユーザがログインしている場合に、ユーザ名を表示 --}}
{{-- Auth::check()は、ユーザがログインしているかどうかを確認するメソッド --}}
{{-- Auth::user()は、現在ログインしているユーザの情報を取得するメソッド --}}
{{-- ユーザ名は、Auth::user()->nameで取得できる --}}
@if(Auth::check())
    <p class="text-right mr-3 pb-3">
        ユーザー：<span class="user-name">{{ Auth::user()->name }}</span>
    </p>
@endif