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
    // ユーザがリクエストを行う権限があるかどうかを判断するメソッド
    // このメソッドは、リクエストが許可されているかどうかを判断するために使用される
     public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    // バリデーションルールを定義
    // このメソッドは、リクエストのデータがどのように検証されるかを定義するために使用される
    public function rules()
    {
        return [
            'youtube_id' => 'required|max:11',
            'title' => 'max:36',
        ];
    }

    // attributesメソッドは、バリデーションエラーメッセージで使用される属性名を定義するために使用される
    // このメソッドをオーバーライドすることで、バリデーションエラーメッセージで表示される属性名をカスタマイズできる
    public function attributes()
    {
        return [
            'youtube_id' => 'YouTube動画ID',
            'title' => '動画タイトル',
        ];
    }
}