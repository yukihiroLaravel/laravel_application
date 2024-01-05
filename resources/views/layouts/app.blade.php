<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>YouTubeまとめ×コミュニケーション</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
</head>

<body>
    @include('commons.header')

    <div class="container">
        @include('commons.error_messages')
        @yield('content')
    </div>

    @include('commons.footer')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

    <script>
        $(function() {
            $(document).on('change', '#user_icon', function() {
                let elem = this //操作された要素を取得
                if (elem.files.length == 0) {
                    document.getElementById('user_icon').value = "";
                    $("#preview-icon").attr('src',
                        '{{ asset('storage/images/user_icon_default.png') }}')
                } else {
                    let fileReader = new FileReader(); //ファイルを読み取るオブジェクトを生成
                    fileReader.readAsDataURL(elem.files[0]); //ファイルを読み取る
                    fileReader.onload = (function() { //ファイル読み取りが完了したら
                        if (fileReader.result) {
                            let imgSrc = fileReader.result //src要素を生成
                            $("#preview-icon").attr('src', imgSrc) //画像をプレビュー
                        }
                    });
                }

            })

            $('#reset-icon').click(function() {
                document.getElementById('user_icon').value = "";
                $("#preview-icon").attr('src',
                    '{{ asset('storage/images/user_icon_default.png') }}')
            })
        });
    </script>
</body>

</html>
