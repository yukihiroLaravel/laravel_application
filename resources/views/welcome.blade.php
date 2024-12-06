@extends('layouts.app')
{{-- @extends('layouts.app') ー 共通化のために作成した app.blade.phpを呼び出す app.blade.phpに埋め込みます --}}

@section('content')
{{-- @section('content')〜@endsection ー 中に書かれた内容を
   app.blade.phpの@yield('content')部分に入れ込む --}}

<div class="center jumbotron bg-dark">
    {{-- jumbotronで、真ん中の四角を形作っている --}}

    <div class="text-center text-white mt-2 pt-1">
        <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ<br>× コミュニケーション</h1>
        {{-- fa-chalkboard-teacherはアイコン appで設定したFont Awesomeから引っ張ってきている --}}
    </div>
</div>
<h5 class="description text-center">みんなの"オススメ"動画を自由にシェアしよう</h5>
@include('users.users', ['users' => $users])
{{-- usersフォルダの中の、users.blade.phpを表示させる
    さらに、第二引数に['users' => $users]を入れることにより、users.blade.phpのファイルでも、$usersの変数が使えるようにする--}}
@endsection