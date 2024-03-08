<header class="mb-5 sticky-top">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand" href="{{ route('index.movie') }}">YouTubeまとめ<br>&ensp;×コミュニケーション</a>

        @if (Auth::check())
            <div class="dropdown navbar-nav">
                <a href="#" class="dropdown-toggle nav-link d-flex align-items-center" id="navbarDropdownMenuLink"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('storage/images' . Auth::user()->icon) }}" alt="user-icon"
                        class="user-icon mr-2">
                    <span class="user-name nav-link">{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a href="{{ route('user.show', Auth::id()) }}" class="dropdown-item">マイページ</a>
                    <a href="{{ route('movie.create') }}" class="dropdown-item">動画登録する</a>
                    <a href="{{ route('user.edit') }}" class="dropdown-item">ユーザー情報編集</a>
                    <a href="{{ route('password.edit') }}" class="dropdown-item">パスワード変更</a>
                    <a href="{{ route('logout') }}" class="dropdown-item">ログアウト</a>
                </div>
            </div>
        @else
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="nav-bar">
                <ul class="navbar-nav align-items-end">
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
                    <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">新規ユーザ登録</a></li>
                </ul>
            </div>
        @endif

    </nav>
</header>
