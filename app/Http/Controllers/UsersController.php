<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id','desc')->paginate(9);

        $users = User::where('name', 'LIKE', "%{$request->search}%")
                    ->orWhere('id', 'LIKE', "%{$request->search}%")
                    ->paginate(9);

        return view('welcome', [
            'users' => $users,
        ]);

    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $movies = $user->movies()->orderBy('id', 'desc')->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);

        return view('users.show',$data);
    }

    public function favorites($id)
    {
        $user = User::findOrFail($id);
        $movies = $user->favorites()->paginate(9);
        $data = [
            'user' => $user,
            'movies' => $movies,
        ];
        $data += $this->userCounts($user);

        return view('users.show', $data);
    }

    //public function search(Request $request)
    //{
        
        //$users = User::where('name', 'LIKE', "%{$request->search}%")
                //->paginate(9);

        //dd($user);

        //return view('users.users', compact('users'));
        
        //return view('welcome', [
          //  'users' => $users,
        //]);
    //}
}
