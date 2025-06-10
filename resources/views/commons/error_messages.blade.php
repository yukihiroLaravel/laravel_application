{{-- エラーの変数が存在する場合に表示 --}}
@if (count($errors) > 0)
{{-- エラーがある場合のメッセージ --}}
    <ul class="alert alert-danger" role="alert">
        {{-- エラーの内容を全て取り出し、１つ１つリスト表示 --}}
        @foreach ($errors->all() as $error)
        {{-- 各エラーをリストで表示 --}}
        {{-- ml-4はBootstrapのクラス --}}
            <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif
