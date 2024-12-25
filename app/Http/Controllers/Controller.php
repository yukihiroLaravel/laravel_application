<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userCounts($user)
    {
        $countMovies = $user->movies()->count();
        $countFavorites = $user->favorites()->count();
        //間違い？→$countComments = $movie ->comments()->count();
        $countComments = $user->movies()->withCount('comments')->get()->sum('comments_count');
        return [
            'countMovies' => $countMovies,
            'countFavorites' => $countFavorites,
            'countComments' => $countComments,
        ];
    } 
    
}
