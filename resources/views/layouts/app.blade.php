<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>YouTubeまとめ×SNS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- asset() ー ヘルパー関数。CSSやJavaScript等へのリンクを簡単に呼び出せる関数。 -->
        <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    </head>
    <body>
        {{-- ヘッダー部分 --}}
        {{-- 共通のヘッダーを表示するために、@includeディレクティブを使用 --}}
        {{-- これにより、ヘッダーの内容を別のファイルに分けて管理できる --}}
        {{-- 例えば、header.blade.phpにヘッダーのHTMLを記述し、ここで読み込む --}}
        {{-- これにより、ヘッダーの内容を一元管理でき、変更が容易になる --}}
        @include('commons.header')
        <div class="container">
            {{-- セッションに保存されたメッセージを表示 --}}
            {{-- セッションに保存されたメッセージは、コントローラで設定したもの --}}
            {{-- 例えば、動画の登録や削除が成功した場合に表示されるメッセージ --}}
            @include('commons.error_messages')
            @include('commons.flash_message')
            {{-- コンテンツ部分 --}}
            {{-- 各ページで異なるコンテンツを表示するために、@yieldディレクティブを使用 --}}
            {{-- @yield('content') は、各ページで定義されたコンテンツをここに挿入する --}}
            {{-- 例えば、movies.blade.phpでは動画の一覧を表示し、create.blade.phpでは動画の登録フォームを表示 --}}
            {{-- これにより、レイアウトを共通化しつつ、各ページで異なる内容を表示できる --}}
            @yield('content')
        </div>
        {{-- フッター部分 --}}
        {{-- 共通のフッターを表示するために、@includeディレクティブを使用 --}}
        {{-- これにより、フッターの内容を別のファイルに分けて管理できる --}}
        {{-- 例えば、footer.blade.phpにフッターのHTMLを記述し、ここで読み込む --}}
        {{-- これにより、フッターの内容を一元管理でき、変更が容易になる --}}
        @include('commons.footer')
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
