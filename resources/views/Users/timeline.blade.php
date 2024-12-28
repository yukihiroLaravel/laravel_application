@extends('layouts.app')

@section('content')
<h1 class="text-center my-4">{{ $user->name }}{{ $user->email_verified_at ? '✅認証' : '（未認証）' }}のアクティビティ</h1>
@include('components.userTab')

<div class="container-fluid mt-4">
    @foreach ($timeline as $item)
    <div class="timeline-item row align-items-start mb-4 p-3 border rounded" style="background-color: #f9f9f9;">
        <!-- 左上: プロフィール -->
        <div class="col-12 col-md-2 text-center mb-2 mb-md-0">
            <img
                src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default_' . ($user->gender ?? 'unknown') . '.png') }}"
                alt="{{ $user->name }}"
                class="img-fluid rounded-circle mb-2"
                style="width: 120px; height: 120px;">
            <p class="font-weight-bold">{{ $user->name }}</p>
        </div>

        <!-- コンテンツエリア -->
        <div class="col-12 col-md-9">
            @if ($item['type'] === 'movie')
            @php $movie = $item['content']; @endphp
            <h5 class="text-secondary">新動画を{{ $item['created_at']->format('Y-m-d H:i') }}に投稿しました</h5>
            <!-- 動画投稿のレイアウト -->
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="embed-responsive embed-responsive-16by9 rounded">
                        <iframe
                            class="embed-responsive-item"
                            src="https://www.youtube.com/embed/{{ $movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <div class="col-12">
                    @if (!empty($movie->description))
                    <p class="p-3 border rounded" style="background-color: #ffffff; word-wrap: break-word;">
                        {!! nl2br(e($movie->description)) !!}
                    </p>
                    @else
                    <p class="text-muted">※この動画には説明が登録されていません。</p>
                    @endif
                </div>
            </div>
            @elseif ($item['type'] === 'comment')
            <!-- コメント投稿のレイアウト -->
            @php $movie = $item['content']->movie; @endphp
            <h5 class="text-secondary">{{ $movie->user->name }}の動画に対しコメントを{{ $item['created_at']->format('Y-m-d H:i') }}に投稿しました</h5>
            <div class="row">
                <div class="col-12 mb-2">
                    <p class="p-3 border rounded" style="background-color: #ffffff; word-wrap: break-word;">{{ $item['content']->content }}</p>
                </div>
                <div class="col-12">
                    @if ($movie)
                    <div class="embed-responsive embed-responsive-16by9 rounded">
                        <iframe
                            class="embed-responsive-item"
                            src="https://www.youtube.com/embed/{{ $movie->youtube_id }}?controls=1&loop=1&playlist={{ $movie->youtube_id }}"
                            allowfullscreen>
                        </iframe>
                    </div>
                    @else
                    <p class="text-danger">関連する動画が見つかりません</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection