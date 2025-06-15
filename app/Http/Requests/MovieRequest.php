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
            // バリデーションルールを定義するメソッド
            // youtube_idは必須で、最大11文字までの文字列
            'youtube_id' => 'required|max:11',
            'title' => 'max:36',
        ];
    }
    public function attributes()
    {
        return [
            // attributesメソッドは、バリデーションエラーメッセージで使用される属性名を定義するためのメソッド
            // ここでは、youtube_idとtitleの属性名を日本語に変更しています。
            'youtube_id' => 'YouTube動画ID',
            'title' => '動画タイトル',
        ];
    }
}