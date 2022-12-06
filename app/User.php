<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes; 
=======
use Illuminate\Database\Eloquent\SoftDeletes;
>>>>>>> feature/shunsuke/maigraton_seeder2

class User extends Authenticatable
{
    use Notifiable;
<<<<<<< HEAD
    use SoftDeletes;
=======
    use softDeletes;
>>>>>>> feature/shunsuke/maigraton_seeder2

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}
