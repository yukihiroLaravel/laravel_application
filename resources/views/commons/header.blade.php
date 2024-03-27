a<header class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="/">YouTubeSummary<br>&ensp;×<br>Communication</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
                    <li class="nav-item"><a href="{{ route('movie.create') }}" class="nav-link">Add Movie</a></li>
                    <li class="nav-item"><a href="" class="nav-link">MyPage</a></li>
                @else 
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">NewRegister</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>
@if(Auth::check())
    <p class="text-right mr-3 pb-3">
         User : <span class="user-name">{{ Auth::user()->name }}</span>
    </p>
@endif