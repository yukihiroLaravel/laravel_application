@extends('layouts.app')
@section('content')

    <div class="row d-flex justify-content-center mb-4">
    <h4 class="mt-5 justify-content-center pb-2">{{ $movie->title }}</h4>
    <iframe class="justify-content-center mt-4" width="400" height="220" src="{{ 'https://www.youtube.com/embed/'.$movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}" frameborder="0"></iframe>
    </div>
    <form method="POST" action="{{ route('comments.comment', $movie->id) }}">
        @csrf
        <div class="row d-flex justify-content-center mt-2">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                <div class="form-outline mb-4">
                <textarea name="new_comment" cols="64" rows="3" class="form-control"></textarea>
                <input type="submit" id="addComment" class="form-control" value="コメント送信" />
                </div>
            <div class="card-body p-4">
                @foreach ($comments as $comment )
                    <div class="card mb-4">
                    <div class="card-body">
                        <p>{{$comment->comment}}</p>

                        <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <p class="small mb-0 ms-2">{{$user->name}} / {{$comment->created_at}}</p>
                        </div>
                        <!-- <div class="d-flex flex-row align-items-center">
                            <p class="small text-muted mb-0">Upvote?</p>
                            <i class="far fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                            <p class="small text-muted mb-0">3</p>
                        </div> -->
                        </div>
                    </div>
                    </div>
                @endforeach
            </div>
            </div>
            <div class="mt-4">
                {{ $comments->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </form>
@endsection