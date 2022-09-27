<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charaset="utf-8">
        <title>YouTubeまとめ×コミュニケーション</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=on">
        <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integraity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOHcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylsheet" href="{{ asset('/css/styles.css') }}">
    </head>
    <body>
        @include('commons.header')
        <div class="container">
            @include('commons.error_messages')
            @yield('content')
        </div>
        @include('commons.footer')
        <script src="https://code.jquery.com/hquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abk41JStQIAqVgRVzpbzo5smXkp4YfRvH+8abtTE1Pi6f\jizo" 
        crossorigin="anonymous">
        </script>
        <sctipt src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
        crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
        crossorigin="anonymous">
        </script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js">
        </script>
    </body>
</html>
