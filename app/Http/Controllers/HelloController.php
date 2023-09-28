<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //
    public function index()
    {
        return 'Hello World!';
    }
    public function view(){
        $data =[
            'msg'=>'こんにちは 幸'
        ];
        return view('hello.view'.$data); 
    }
}
