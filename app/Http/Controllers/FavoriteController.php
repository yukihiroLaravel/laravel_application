<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store($id)
    {
        \Auth::user()->favorite($id);
        return back()->with('success', __('messages.favorite_created'));
    }
    
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);
        return back()->with('success', __('messages.favorite_deleted'));
    }
}
