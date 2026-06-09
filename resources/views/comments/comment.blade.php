<div class="card mb-2">
    <div class="card-body">
        <p>{{ $comment->content }}</p>

        <p class="text-muted mb-0">
            投稿者：{{ $comment->user->name }}
            ／ 投稿日時：{{ $comment->created_at }}
        </p>

        <div class="d-flex align-items-center mt-2">
            @if (Auth::check())
                <button
                    class="btn btn-outline-primary btn-sm mr-2"
                    type="button"
                    data-toggle="collapse"
                    data-target="#reply-form-{{ $comment->id }}"
                    aria-expanded="false"
                    aria-controls="reply-form-{{ $comment->id }}">
                    返信する
                </button>
            @endif

            @if ($comment->replies->count() > 0)
                <button
                    class="btn btn-outline-secondary btn-sm mr-2"
                    type="button"
                    data-toggle="collapse"
                    data-target="#replies-{{ $comment->id }}"
                    aria-expanded="false"
                    aria-controls="replies-{{ $comment->id }}">
                    返信を表示 {{ $comment->replies->count() }}件
                </button>
            @endif

            @if (Auth::id() === $comment->user_id)
                <a href="{{ route('comment.edit', $comment->id) }}" class="btn btn-primary btn-sm mr-2">
                    編集する
                </a>

                <form method="POST" action="{{ route('comment.delete', $comment->id) }}" class="mb-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">削除する</button>
                </form>
            @endif
        </div>

        @if (Auth::check())
            <div class="collapse mt-3" id="reply-form-{{ $comment->id }}">
                <form method="POST" action="{{ route('comment.reply', $comment->id) }}">
                    @csrf

                    <div class="form-group">
                        <textarea
                            name="content"
                            class="form-control"
                            rows="2"
                            maxlength="1000"
                            placeholder="返信を入力してください"
                        >{{ old('content') }}</textarea>

                        <small class="form-text text-muted">
                            最大1000文字まで入力できます。
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">返信する</button>
                </form>
            </div>
        @endif

        @if ($comment->replies->count() > 0)
            <div class="collapse ml-4 mt-3" id="replies-{{ $comment->id }}">
                @foreach ($comment->replies as $reply)
                    @include('comments.comment', ['comment' => $reply])
                @endforeach
            </div>
        @endif
    </div>
</div>