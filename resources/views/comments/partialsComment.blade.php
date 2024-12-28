<div class="media mb-4">
    <img class="me-3 rounded-circle" src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('images/default_' . ($comment->user->gender ?? 'unknown') . '.png') }}" alt="{{ $comment->user->name }}" width="100">
    <div class="media-body">
        <h5 class="mt-0">{{ $comment->user->name }}</h5>

        <p>{{ $comment->content }}</p>

        <p class="text-muted" style="font-size: 0.8em;">
            {{ $comment->created_at->format('Y-n-d H:i:s') }}
            @if ($comment->updated_at && $comment->updated_at->ne($comment->created_at))
            （ 編集済み）
            @endif
        </p>

        <!-- 編集・削除ボタン -->
        @if (auth()->check())
            @if (auth()->id() === $comment->user_id || auth()->id() === $movie->user_id)
                <form action="{{ route('comment.delete', [$movie->id, $comment->id]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                </form>
            @endif
            @if (auth()->id() === $comment->user_id)
                <button class="btn btn-secondary btn-sm" onclick="editComment({{ $comment->id }})">編集</button>
                <form id="edit-form-{{ $comment->id }}" action="{{ route('comment.update', [$movie->id, $comment->id]) }}" method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                    <textarea name="content" class="form-control" rows="2">{{ $comment->content }}</textarea>
                    <button type="submit" class="btn btn-primary btn-sm mt-1">保存</button>
                </form>
            @endif
        @endif

        <!-- 返信フォーム -->
        @auth
            <button class="btn btn-link btn-sm" onclick="replyToComment({{ $comment->id }})">返信</button>
            <form id="reply-form-{{ $comment->id }}" action="{{ route('comment.store', $movie->id) }}" method="POST" class="mt-2" style="display: none;">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea name="content" class="form-control" rows="2" required></textarea>
                <button type="submit" class="btn btn-primary btn-sm mt-2">返信を投稿</button>
            </form>
        @endauth

        <!-- 子コメントの再帰的表示 -->
        @if ($comment->replies->isNotEmpty())
            <div class="ms-3 border-start ps-3 mt-3">
                @foreach ($comment->replies as $reply)
                    @include('comments.partialsComment', ['comment' => $reply, 'movie' => $movie])
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
    function replyToComment(commentId) {
        const form = document.getElementById(`reply-form-${commentId}`);
        if (form) {
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
            const parentInput = form.querySelector('input[name="parent_id"]');
            if (!parentInput) {
                console.error(`parent_id input not found for commentId: ${commentId}`);
            }
        } else {
            console.error(`Reply form not found for commentId: ${commentId}`);
        }
    }
</script>

<script>
    function editComment(commentId) {
        const form = document.getElementById(`edit-form-${commentId}`);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
