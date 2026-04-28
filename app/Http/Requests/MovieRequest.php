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

    // ここをtrueに変更することで、バリデーションが有効になる
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
            // チェックして、配列で返す
            'youtube_id' => 'required|max:18',
            'title' => 'required|max:36',
        ];
    }

    // バリデーションエラーの項目名を日本語にする
    public function attributes()
    {
        return [
            'youtube_id' => 'YouTube動画ID',
            'title' => '動画タイトル',
        ];
    }
}
