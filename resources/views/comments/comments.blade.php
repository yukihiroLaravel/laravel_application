<h2 class="mt-5">コメント一覧</h2>

@if ($comments->total() > 0)
    @foreach ($comments as $comment)
        <div class="card mb-2">
            <div class="card-body">
                <p>{{ $comment->content }}</p>
                <p class="text-muted mb-0">
                    投稿者：{{ $comment->user->name }}
                    ／ 投稿日時：{{ $comment->created_at }}
                </p>

                @if (Auth::id() === $comment->user_id)
                  <div class="d-flex align-items-center mt-2">
                    <a href="{{ route('comment.edit', $comment->id) }}" class="btn btn-primary btn-sm mr-2">編集する</a>
                  
                    <form method="POST" action="{{ route('comment.delete', $comment->id) }}"  class="mb-0">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">削除する</button>
                    </form>
                  </div>
                @endif

            </div>
        </div>
    @endforeach

    {{ $comments->links('pagination::bootstrap-4') }}
@else
    <p>まだコメントはありません。</p>
@endif