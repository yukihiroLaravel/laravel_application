<header class="mb-5 sticky-top">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">YouTubeまとめ<br>&ensp;×コミュニケーション</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">
                        <a href="{{ route('user.show') }}" class="nav-link">
                            <img src="{{ asset('storage/images/' . Auth::user()->icon) }}" alt="user-icon"
                                class="user-icon">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('movie.create') }}" class="nav-link">動画登録する</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('user.edit') }}" class="nav-link">ユーザー情報編集</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('password.edit') }}" class="nav-link">パスワード変更</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">ログアウト</a>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
                    <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">新規ユーザ登録</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>
