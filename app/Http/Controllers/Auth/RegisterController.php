<?php

namespace App\Http\Controllers\Auth;

/**
 * namespace ー このクラス全体の名前空間を示す
 * use ー 他のクラスを外部から呼び出すときに使う
 * namespace や use という記述が「名前空間」を示します。
 * ディレクトリのような階層構造で、「どのクラスを呼び出して使うのか？」を明示的に示すことができます。
 * 例えば、同じクラス名のクラスが２つ以上存在する場合、その２つのクラスを別物として扱うべきなので、
 * どちらのクラスを呼び出しているのか？を理解できるように、名前空間で違いを判断します。
*/

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

    /*
     * web.phpファイル内にshowRegistrationFormとregisterは定義されていて、
     * ここでは上記のように「use RegistersUsers」と記載する（「トレイト」と言われる）
     * Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
     * Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
    */

    // protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo = '/';

    /* ユーザ登録後の画面遷移
     * ユーザ登録処理が正常に実行された後は、自動的に別のページに画面遷移するように
     * 設定しておかないといけません。遷移先のURLを指定する必要がありますが、
     * それが指定されているのが、$redirectTo 変数です。
     * 登録後、トップページに遷移させるようにしたいので、上記のように’/’を記述してください。
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

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
}
