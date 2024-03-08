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
                    <p class="mb-2">アイコン画像</p>
                    <div class="preview-box mb-2">
                        <img src="{{ asset('storage/images' . $user->icon) }}" alt="ユーザーアイコン" id="preview-new_icon"
                            class="preview-icon active">
                        <img src="{{ asset('storage/images' . $user->icon) }}" alt="ユーザーアイコン" id="preview-current_icon"
                            class="preview-icon">
                        <img src="{{ asset('storage/images/user_icon_default.png') }}" alt="ユーザーアイコン"
                            id="preview-default_icon" class="preview-icon">
                    </div>
                    <div class="d-flex flex-gap-1">
                        <label class="upload-icon">
                            編集
                            <input type="file" class="d-none" name="icon" accept=".png, .jpg, .jpeg">
                        </label>
                        <button type="button" id="reset-icon">リセット</button>
                    </div>

                    <div class="d-none">
                        <label>
                            <input type="radio" name="icon_status" value="new_icon">
                            new
                        </label>

                        <label>
                            <input type="radio" name="icon_status" value="current_icon" checked>
                            current
                        </label>

                        <label>
                            <input type="radio" name="icon_status" value="default_icon">
                            defo
                        </label>
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
