<h2 class="mt-5">コメント一覧</h2>

@if ($comments->total() > 0)
    @foreach ($comments as $comment)

        @include('comments.comment', ['comment' => $comment])

    @endforeach

    {{ $comments->links('pagination::bootstrap-4') }}
@else
    <p>まだコメントはありません。</p>
@endif