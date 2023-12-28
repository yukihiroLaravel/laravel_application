<h2 class="mt-<h2 class="mt-5 mb-5">チャンネル一覧</h2>
<div class="movies row mt-5 text-center">
    @foreach ($users as $user)
    {{--コントローラから受け取った変数「$users」から１人１人のユーザを取り出して繰り返す--}}
        @php
            $movie = $user->movies->last();
        @endphp
        @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
        {{--$loop->iteration とは、Laravelの繰り返し処理中で使えるプロパティで、「今が何回目の繰り返しか？」と示してくれます。--}}
{{--「３で割ったら余りが１」となった場合、つまりここでは４番目（or ７番目）のユーザ情報を表示する前に--}}
{{--<div>終了タグを強制的に差し込んで改行させる意味があります。--}}
          </div>
            <div class="row text-center mt-3">
        @endif
            <div class="col-lg-4 mb-5">
                <div class="movie text-left d-inline-block">
                ＠{{ $user->name }}
                    <div>
                        @if ($movie)
                        {{--ユーザが動画を所有している場合は下記を表示--}}
                            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
                        @else
                        {{--１つも動画を所有していない場合は下記を表示--}}
                            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
                        @endif
                    </div>
                    <p>
                        @if (isset($movie->title))
                        {{----}}


                            {{ $movie->title }}
                        @endif
                    </p>
                </div>
            </div>
    @endforeach
</div>
{{ $users->links('pagination::bootstrap-4') }}
{{--ページネーション、９人区切りで次のページに表示される--}}