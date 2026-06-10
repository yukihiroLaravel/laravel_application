@if (Auth::check())
    <h2 class="mt-5">コメント投稿</h2>

    <form method="POST" action="{{ route('comment.store', $movie->id) }}">
        @csrf

        <input type="hidden" name="comment_error_target" value="comment">

        <div class="form-group">
            <textarea
                name="content"
                class="form-control"
                rows="3"
                maxlength="1000"
                placeholder="コメントを入力してください"
            >{{ old('content') }}</textarea>

            @if (session('comment_error_target') === 'comment' && $errors->has('content'))
                <div class="alert alert-danger mt-2">
                    {{ $errors->first('content') }}
                </div>
            @endif

            <small class="form-text text-muted">
                最大1000文字まで入力できます。
            </small>
        </div>

        <button type="submit" class="btn btn-primary">コメントする</button>
    </form>
@else
    <p class="mt-5">
        コメントを投稿するにはログインしてください。
    </p>
@endif