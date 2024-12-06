<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    //authorize()でフォームリクエストを使えるようにするかというメソット。 falseからtrueに変更。
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'youtube_id' => 'required|max:11',
            'title' => 'max:36',
        ];
        //ここの「youtube_id」「title」は、create.blade.phpで書いたname属性
    }

    public function attributes()
    {
        return [
            'youtube_id' => 'YouTube動画ID',
            'title' => '動画タイトル',
        ];
        //バリデーションエラーを日本語で表示させるため
        //attributes=属性
        //name属性を日本語化する
        //例：YouTube動画IDは必須です のように
    }
}
