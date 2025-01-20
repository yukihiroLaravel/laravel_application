<div class="movies row mt-5 text-center">
  @foreach ($movies as $movie)
  {{-- create.blade.phpに、@include('movies.movies', ['movies' => $movies])があるから、$movies変数が使用できる --}}

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
      @php
        $countFavoriteUsers = $movie->favoriteUsers()->count();
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
        <div class="text-right mb-2">いいね!
          <span class="badge badge-pill badge-success">{{ $countFavoriteUsers }}</span>
        </div>
        <div>
          @if ($movie)
            <iframe width="290" height="163.125" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
          {{-- $movie が存在する場合、$movie->youtube_id: $movie の中に保存されている youtube_id（YouTube 動画の ID）を取得 --}}

          @else
            <iframe width="290" height="163.125" src="https://www.youtube.com/embed/" frameborder="0"></iframe>
          @endif
        </div>
        {{-- $movie が存在しない場合、空の埋め込み YouTube プレイヤーを表示 --}}

      <p>
        @if (isset($movie->title))
          {{ $movie->title }}
        @else
          {{ $videoTitle }}
        @endif
      </p>
      {{-- 動画のtitleプロパティが存在する場合のみ、動画タイトルを表示するという意味 --}}
      {{-- isset()は、指定した変数やプロパティが 設定されているかつ null ではないかを確認 nullでない場合にtrueを返す --}}

      @if (isset($movie->comment))
      {{ $movie->comment }}
      @endif
      </p>
      @include('favorite.favorite_button', ['movie' => $movie])
      @if (Auth::id() === $movie->user_id)
      {{-- ログインしたユーザーと動画の所有者のidが一致した場合のみ、削除できる --}}
        <div class="d-flex justify-content-between">
          <form method="POST" action="{{ route('movie.delete', $movie->id) }}">
          {{-- $movie->id はweb.php(ルート)の中の'{id}'に指定されるid --}}
            @csrf
            {{-- postの時は、必ず@csrfが必要 --}}

            @method('DELETE')
            {{-- 上ではPOSTメソットだったから、そこからDELETEメソットの上書き
            @method('DELETE')は、formタグの中にいれておく。 
          ララベルではPOSTとgetしかmethod="POST"のように書けない。DELETEとか更新はPostの一種。それ以外のDELETEや更新は、自分で@method('DELETE')のように書く--}}

            <button type="submit" class="btn btn-danger">この動画を削除する</button>
          </form>
          <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-primary">編集する</a>
        </div>
      @endif
    </div>
  </div>
  @endforeach
</div>
{{ $movies->links('pagination::bootstrap-4') }}

{{-- $movies->links()で、ページネーションリンク（次のページや前のページへのリンク）を生成する
ここでは、$moviesが、paginate() メソッドを使って取得されたデータであるから、$movies->links()が使用できる。
データが複数ページに分かれている場合に、ページ間の移動リンクを自動で生成してくれる --}}