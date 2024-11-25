@extends('layouts.app')
{{-- @extends('layouts.app') ー 共通化のために作成した app.blade.phpを呼び出す 
    app.blade.phpに埋め込みますよ --}}

@section('content')
{{-- @section('content')〜@endsection ー 中に書かれた内容を
    app.blade.phpの@yield('content')部分に入れ込む --}}

<div class="center jumbotron bg-dark">
    {{-- jumbotronで、真ん中の四角を形作っている --}}

    <div class="text-center text-white mt-2 pt-1">
        <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ</h1>
        {{-- fa-chalkboard-teacherはアイコン appで設定したFont Awesomeから引っ張ってきている --}}
        <h1>× コミュニケーション</h1>
    </div>
</div>
<h5 class="description text-center">みんなの"オススメ"動画を自由にシェアしよう</h5>
@endsection