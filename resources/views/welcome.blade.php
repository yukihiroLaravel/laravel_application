{{-- @extendsなので、welcome.blade.phpは、app.blade.phpを継承している --}}
{{-- app.blade.phpの内容を、welcome.blade.phpで上書きする --}}
{{-- つまり、app.blade.phpの内容が、welcome.blade.phpの内容に置き換わる --}}
{{-- そのため、app.blade.phpの内容を変更すると、welcome.blade.phpにも反映される --}}
{{-- 逆に、welcome.blade.phpの内容を変更しても、app.blade.phpには影響しない --}}
@extends('layouts.app')
{{-- app.blade.phpにあるyield('content')の部分に、welcome.blade.phpの内容を表示する --}}
{{-- @section('content')と@endsectionの間に記述した内容が、app.blade.phpのyield('content')に挿入される --}}
@section('content')
    <div class="center jumbotron bg-dark">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>YouTubeまとめ</h1>
            <h1>× コミュニケーション</h1>
        </div>
    </div>
    <h5 class="description text-center">みんなの"オススメ"動画を自由にシェアしよう</h5>
@endsection