@extends('layouts.app')
@section('content')
    <div class="text-center">
        <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeSummary×Communication</h1>
    </div>
    <div class="text-center mt-3">
        <p class="text-letf d-inline-block">When your login,<br>You Create own chanenel & Movie adding.</p>
    </div>
    <div class="text-center">
        <h3 class="login_title text-left d-inline-block mt-5">Login</h3>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-6 offset-sm-3">
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">PassWord</label>
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Login</button>
            </form>
            <div class="mt-2"><a href="{{ route('signup') }}">New Register？</a></div>
        </div>
    </div>
@endsection