@extends('layouts.app')
@section('content')
<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container" style="max-width: 500px; margin-top: 50px;">
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

                    @if($user->profile_picture)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="現在のプロファイル写真" style="max-width: 150px; max-height: 150px;">
                        <!-- 削除ボタン -->
                        <button type="button" class="btn btn-danger mt-2" onclick="deletePicture()">写真を削除</button>
                    </div>
                    @endif
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

<!-- 外部に作成した DELETE フォーム -->
<form id="delete-profile-picture-form" action="{{ route('profile.deletePicture') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- JavaScriptでDELETEフォームを送信 -->
<script>
    function deletePicture() {
        if (confirm('本当にプロファイル写真を削除しますか？')) {
            document.getElementById('delete-profile-picture-form').submit();
        }
    }
</script>


<!-- フォームの構造を調整 
<form id="profile-picture-form" action="{{ route('profile.uploadPicture') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="profile_picture" class="form-label">プロファイル写真:</label>
        <input type="file" name="profile_picture" id="profile_picture" class="form-control">
        <p class="text-danger mt-2" id="error-message" style="display: none;"></p>
    </div>
</form>

<div class="mt-3">
    <img id="profile-picture-preview" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : '' }}" 
         alt="現在のプロファイル写真" style="max-width: 150px; max-height: 150px; display: {{ $user->profile_picture ? 'block' : 'none' }};">
</div>-->

<!-- JavaScriptでアップロード処理とプレビュー更新 -->
<script>
    document.getElementById('profile_picture').addEventListener('change', function () {
        const fileInput = this;
        const formData = new FormData();
        formData.append('profile_picture', fileInput.files[0]);

        // CSRFトークンをヘッダーに追加
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // AJAXリクエスト
        fetch("{{ route('profile.uploadPicture') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // プレビューの画像を更新
                const preview = document.getElementById('profile-picture-preview');
                preview.src = data.url; // サーバーから返された新しい画像のURL
                preview.style.display = 'block';
            } else {
                // エラーメッセージを表示
                document.getElementById('error-message').innerText = data.error;
                document.getElementById('error-message').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
<!-- パスワード変更 -->
<div class="container text-center my-2" >
  <a href="{{ route('auth.changePassword') }}" class="btn btn-secondary">パスワードを変更する</a>
</div>

<!-- 退会 -->
<div class="container text-center my-2">
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