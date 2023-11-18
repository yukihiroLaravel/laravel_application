<header class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-barnd" href="/">YouTubeまとめ<br>&ensp;×コミュニケーション</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="navitem"><a href="{{ route('logout') }}" class="nav-item">ログアウト</a></li>
                    <li class="nav-itme"><a href="" class="nav-link">マイページ</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('login')}}" class="navlink">ログイン</a></li>
                    <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">新規ユーザー登録</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>
@if(Auth::check())
    <p class="text-right mr-3 pb-3">ユーザー: <span class="user-name">{{ Auth::user()->name}}</span>
    </p>
@endif