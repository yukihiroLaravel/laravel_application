<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PracticesController extends Controller
{
    public function index(){
         return view('practice');
    }
}
