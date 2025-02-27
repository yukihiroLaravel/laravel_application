<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'task_name' => 'required|max:255',
            'due_date' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'task_name' => 'タスク名',
            'due_date' => '期限',
        ];
    }
}
