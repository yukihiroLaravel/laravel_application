<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  {{-- HTML文書の文字エンコーディング（文字の表現方法）を指定する --}}

  <title>YouTubeまとめ×コミュニケーション</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  {{-- レスポンシブデザインをサポート --}}

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
  {{-- asset()でcssとかJavaScriptとかを簡単に呼び出せる関数
    ここでは、'/css/styles.css'というファイルを呼び出している --}}

</head>
{{-- HTMLドキュメントに 外部スタイルシート をリンクするためのタグ。
  この場合、外部の Bootstrap 4.3.1 のCSSファイル を読み込むことを意味 --}}
{{-- セキュリティに関連する属性 --}}

<body>
  @include('commons.header')
  {{-- このファイルではincludeが重要 --}}

  <div class="container">
    {{-- BootstrapなどのCSSフレームワークでよく使われるクラスcontainer指定
      ページ全体のレイアウトを中央に整えるためのコンテナ要素 --}}

    @include('commons.error_messages')
    {{-- includeで他のファイルを呼び出し、埋め込んでいる ここでは特定のファイルを指定している --}}

    @yield('content')
    {{-- 各ページへの呼び出し HTMLとPHPコードを簡潔に書けるようにしている
      @という形で表現し、phpを読み込みやすくしている 各ページに固有の内容を埋め込む --}}
  </div>
  @include('commons.footer')

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  {{-- jQueryのJavaScriptファイルを外部から読み込むためのスクリプトタグ。
  さらに、読み込む際に安全性を向上させるための integrity と crossorigin 属性が含まれている --}}

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  {{-- Popper.js というJavaScriptライブラリを外部から読み込むためのスクリプトタグ。
  Popper.js は、ツールチップ（tooltip）やポップオーバー（popover） など、位置に基づくUI要素の動作を支えるために使われる。
  特に、Bootstrapでこれらの機能を使う場合に必要となるライブラリ。 --}}

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  {{-- Bootstrap 4のJavaScriptライブラリを外部から読み込むためのスクリプトタグ。
 Bootstrapの多くのインタラクティブな機能（モーダル、ドロップダウン、ツールチップなど）を利用するためには、
 このJavaScriptファイルが必要 --}}

  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
  {{-- Font Awesome というアイコンフォントライブラリを利用するためのJavaScriptファイルを外部から読み込むスクリプトタグ。
  Font Awesomeを使うと、Webページ上で簡単にアイコンを表示できる  --}}

</body>

</html>