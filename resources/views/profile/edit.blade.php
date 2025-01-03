@extends('layouts.app')
@section('content')
@include('components.success')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container" style="max-width: 600px; margin-top: 50px;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">プロフィール更新</h5>

                <!-- ニックネーム -->
                <div class="mb-3">
                    <label for="nickname" class="form-label">ニックネーム:</label>
                    <input type="text" name="nickname" id="nickname" class="form-control" value="{{ old('nickname', $user->nickname) }}">
                    @error('nickname')<p class="text-danger mt-2">{{ $message }}</p>@enderror
                </div>

                <!-- 性別 -->
                <div class="mb-3">
                    <label for="gender" class="form-label">性別:</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>男性</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>女性</option>
                        <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>特殊</option>
                        <option value="unknown" {{ $user->gender == 'unknown' ? 'selected' : '' }}>教えたくない</option>
                    </select>
                    @error('gender')<p class="text-danger mt-2">{{ $message }}</p>@enderror
                </div>

                <!-- プロファイル写真 -->
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">プロファイル写真:</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                    @error('profile_picture')<p class="text-danger mt-2">{{ $message }}</p>@enderror

                    <div id="profile-picture-preview" class="mt-3">
                        @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="現在のプロファイル写真" style="max-width: 150px; max-height: 150px;">
                        <!-- 削除ボタン -->
                        <button type="button" class="btn btn-danger mt-2" onclick="deletePicture()">写真を削除</button>
                        @endif
                    </div>
                </div>

                <!-- 自己紹介 -->
                <div class="mb-3">
                    <label for="self_introduction" class="form-label">自己紹介:</label>
                    <textarea name="self_introduction" id="self_introduction" class="form-control">{{ old('self_introduction', $user->self_introduction) }}</textarea>
                    @error('self_introduction')<p class="text-danger mt-2">{{ $message }}</p>@enderror
                </div>

                <!-- 更新ボタン -->
                <button type="submit" class="btn btn-primary w-100">更新</button>
            </div>
        </div>
    </div>
</form>

<script>
document.getElementById('profile_picture').addEventListener('change', function (event) {
    const formData = new FormData();
    formData.append('profile_picture', event.target.files[0]);

    fetch("{{ route('profile.uploadTemp') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const previewDiv = document.getElementById('profile-picture-preview');
                previewDiv.innerHTML = `
    <img src="${data.imageUrl}" alt="アップロードされたプロファイル写真" style="max-width: 150px; max-height: 150px;">
        <button type="button" class="btn btn-danger mt-2" onclick="deletePicture()">写真を削除</button>
        `;
            } else {
                alert(data.error || 'アップロードに失敗しました');
            }
        })
        .catch(error => console.error('Error:', error));
});

function deletePicture() {
    fetch("{{ route('profile.deleteTemp') }}", {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const previewDiv = document.getElementById('profile-picture-preview');
                previewDiv.innerHTML = ''; // プレビューをクリア
            } else {
                alert(data.error || '削除に失敗しました');
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>

<!-- パスワード変更 -->
<div class="container text-center my-3">
    <a href="{{ route('auth.changePassword') }}" class="btn btn-secondary w-50 py-2">パスワードを変更する</a>
</div>

<!-- E-mail認証 -->
<div class="container text-center my-3">
    @if (!auth()->user()->hasVerifiedEmail()) <!-- Eメール未認証の場合に表示 -->
    <form method="POST" action="{{ route('user.sendVerification') }}">
        @csrf
        <button type="submit" class="btn btn-primary w-50 py-2">email認証</button>
    </form>
    @endif
</div>

<!-- 退会 -->
<div class="container text-center my-3">
    {{-- profile.blade.php --}}
    @if (auth()->id() === $user->id)
    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('本当に退会しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger w-50 py-2">退会</button>
    </form>
    @endif
</div>


@endsection