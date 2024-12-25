<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{

    protected $fillable = [
        'title',
        'is_completed',
    ];

    public static function rules(){
        return [
            'title' => 'required|max:255',
            'is_completed' => 'nullable|boolean',
        ];
    }
}
