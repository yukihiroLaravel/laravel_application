<h2 class="mt-5 mb-5">チャンネル一覧</h2>
<div class="movies row mt-5 text-center">
  @foreach ($users as $user)

  {{-- UsersControllerからの$usersの変数 --}}
  {{-- welcome.blade.phpに、
  @include('users.users', ['users' => $users])
  という記載があるから、users.blade.phpのこのファイルでも$usersの変数が使用できる
  --}}

  @php
  $movies = $user->movies()->get();
  $totalFavorites = 0;
  foreach ($movies as $movie) {
    $totalFavorites += $movie->favoriteUsers()->count();
  }
  $movie = $user->movies->last();
  $videoTitle = "動画が未登録です";
  if ($movie) {
    $keyName = config('app.YouTubeDataApiKey');
    $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$movie->youtube_id}&key={$keyName}&part=snippet";
    $jsonData = file_get_contents($apiUrl);
    if ($jsonData) {
      $decodeData = json_decode($jsonData, true);
      if ($decodeData['pageInfo']['totalResults'] !== 0) {
        $videoTitle = $decodeData['items']['0']['snippet']['title'];
      }
    } else {
        $videoTitle = "一時的な情報制限中です";
    }
  }
  @endphp

  {{-- モデルのuser.phpのmovies関数から、「movies」はきている 既に、$user->movies()->get();とインスタンス化しているため --}}
  {{-- last()で最新を表示  --}}
  {{-- つまり、$movie = $user->movies->last();で
  ユーザーのもつ最新の動画1つを、$movieに代入する --}}

  @if ($loop->iteration % 3 === 1 && $loop->iteration !== 1)
</div>
{{-- $loop は、Bladeテンプレートで繰り返し処理を行う際に使用できる特別な変数  iterationはプロパティ 
    blade.phpファイルの、foreachやfor文などの繰り返し処理の構文でのみ使用できる
  「$loop->iteration」で、1から始まり、今何回目の繰り返しかを表現してくれる --}}
{{-- 「div」の終了タグを設けているので、指定の繰り返しのところで改行される、という意味 --}}

<div class="row text-center mt-3">
  @endif
  <div class="col-lg-4 mb-5">
    <div class="movie text-left d-inline-block">
      <div class="text-right">
        <span class="badge badge-pill badge-success">{{ $totalFavorites }} いいね!</span>
      </div>
      <a href="{{ route('user.show', $user->id) }}">＠{{ $user->name }}</a>
      <div>
        @if ($movie)
        <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>

        {{-- モデルのuser.phpのmovies関数から、「movies」はきている 既に、$user->movies()->get();とインスタンス化しているため
        上で、$movie = $user->movies->last();と、ユーザーのもつ最新の動画1つを、$movieに代入されているので、moviesカラムのyoutube_idが使用できる --}}
        {{-- iframeは埋め込みのタグ  --}}

        @else
        <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
        @endif
      </div>
      <p>
        @if (isset($movie->title))
        {{ $movie->title }}
        @else
        {{ $videoTitle }}
        @endif
        {{-- 動画のtitleプロパティが存在する場合のみ、動画タイトルを表示するという意味  --}}
        {{-- isset()は、指定した変数やプロパティが 設定されているかつ null ではないかを確認 nullでない場合にtrueを返す  --}}
      </p>
    </div>
  </div>
  @endforeach
</div>
{{ $users->links('pagination::bootstrap-4') }}

{{-- $users->links()で、ページネーションリンク（次のページや前のページへのリンク）を生成する
ここでは、$usersが、paginate() メソッドを使って取得されたデータであるから、$users->links()が使用できる。
データが複数ページに分かれている場合に、ページ間の移動リンクを自動で生成してくれる
  --}}

{{-- 'pagination::bootstrap-4'は、Laravelにあらかじめ用意されているテンプレート。Bootstrap 4 用のクラスを持つページネーションリンクを生成するということ --}}