@extends('layouts.app')
@section('content')
    <div class="text-center">
        <h3 class="login_title text-left d-inline-block mt-5">ユーザー設定変更</h3>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-6 offset-sm-3">
            <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group d-flex flex-column align-items-center">
                    <p>
                        アイコン画像
                    </p>
                    <img src="{{ asset('storage/images/' . Auth::user()->icon) }}" alt="ユーザーアイコン" id="preview-icon"
                        class="mb-2">
                    <div class="d-flex flex-gap-1">
                        <label class="upload-icon">
                            編集
                            <input type="file" id="user_icon" name="icon" accept=".png, .jpg, .jpeg"
                                value="{{ $user->icon }}">
                        </label>
                        <button type="button" id="reset-icon">削除</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">名前</label>
                    <input id="name" type="text" class="form-control" name="name"
                        value="{{ old('name') ?? $user->name }}">
                </div>

                <div class="form-group">
                    <label for="new_email">メールアドレス</label>
                    <input id="new_email" type="text" class="form-control" name="new_email"
                        value="{{ old('new_email') ?? $user->email }}">
                </div>

                <button type="submit" class="btn btn-primary mt-4">変更を保存する</button>
            </form>
        </div>
    </div>
@endsection
