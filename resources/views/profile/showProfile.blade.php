@extends('layouts.app')
@section('content')

<h1>{{ $user->name }}</h1>
@include('components.userTab')

@include('components.success')

<div class="container text-center" my-5> <!-- style="height: 100vh;"を削除、my-5を追加（上下に余白）-->
  <!-- ユーザープロフィールタイトル -->
  <h1>{{ $user->nickname ?? $user->name }}さんのプロフィール</h1>

  <!-- ユーザープロフィールカード -->
  <div class="card mx-auto mt-4" style="width: 36rem;">　<!--mt-4 を追加（カードの上部に余白）-->
    <div class="card-body text-center">
      <!-- ヘッダー -->
      <h5 class="card-title mb-3">{{ $user->nickname }}</h5>

      <!-- 性別 -->
      <p class="card-text">
        性別: 
        {{ $user->gender == 'male' ? '男性' : ($user->gender == 'female' ? '女性' :($user->gender == 'other' ? '特殊' : '不明')) }}
      </p>

      <!-- プロフィール写真 -->
      <p>
        @if ($user->profile_picture)
          <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="プロフィル写真" class="img-fluid rounded-circle mb-3" style="width: 300px; height: 300px;">
        @else
          <img src="{{ asset('images/default_' . $user->gender . '.png') }}" alt="デフォルト写真" class="img-fluid rounded-circle mb-3" style="width: 300px; height: 300px;">
        @endif
      </p>
    </div>
      <!-- 自己紹介 -->
    <h5 class="card-title">自己紹介:</h5>
    <p>{{ $user->self_introduction ?? '自己紹介はまだありません。' }}</p>
  </div>
</div>
<div class="container text-center" my-5>
{{-- profile.blade.php --}}
@if (auth()->id() === $user->id)
    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('本当に退会しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">退会</button>
    </form>
@endif
</div>
@endsection