<ul class="nav nav-tabs nav-justified mt-5 mb-2">
    <li class="nav-item nav-link {{ Request::is('users/'. $user->id) ? 'active' : '' }}"><a href="{{ route('user.show', $user->id) }}">動 画<br>
            <div class="badge badge-secondary">{{ $countMovies ?? ''}}</div>
        </a></li>
    <li class="nav-item nav-link {{ Request::is('users/'. $user->id. '/favorites') ? 'active' : '' }}"><a href="{{ route('user.favorites', $user->id) }}">お気に入り<br>
            <div class="badge badge-secondary">{{ $countFavorites ?? 777}}</div>
        </a></li>
    <li class="nav-item nav-link {{ Request::is('users/'. $user->id) ? 'active' : '' }}"><a href="{{ route('profile.showProfile', $user->id) }}">{{ $user->name }}の詳細<br>
            <div class="badge badge-secondary">Profile</div>
        </a></li>
</ul>