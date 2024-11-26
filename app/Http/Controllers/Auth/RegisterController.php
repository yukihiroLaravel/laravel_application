<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    // ユーザー登録が正常に行われた場合、ログイン後の画面が表示されるメソッド

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    // 最初に呼び出されるメソッド
    //新規登録ページが未ログインのユーザーにだけ表示されるようにする
    //ログイン済みのユーザーが不必要に新規登録ページにアクセスするのを防いでいる

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    //バリデーション＝検証
    //required=入力必須
    //unique:users=他のメアドと重複していないか検証
    //confirmed=パスワード確認 確認欄に記載のパスワードが、誤っていたらエラーを出す備え付けのバリデーション処理



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    //新規ユーザーのデータをデータベースに保存するための処理を定義するメソッド
    //「User」つまりモデルを通じてデータベースに接続している？
    //でも「User」の中に、それらしい記述がないんだよな、、
    //デーブルとカラムを作成した「Migration」に繋がっているのかな？？
    //create関数を使用し、配列$dataの中に、名前を入れることにより、データベースに保存される仕組みかなぁ？？

}

//コントローラーからビューに返すと思うんだけど、「return view」がない。なぜ？