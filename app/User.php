<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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

    //userとmovieを結びつけている関数
    public function favorites()
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }

    public function favorite($movieID)
    {
        $exist = $this->isFavorite($movieID);
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($movieID);
            return true;
        }
    }

    public function unfavorite($movieID)
    {
        $exist = $this->isFavorite($movieID);
        if ($exist) {
            $this->favorites()->detach($movieID);
            return true;
        } else {
            return false;
        }
    }



    public function isFavorite($movieID)
    {
        return $this->favorites()->where('movie_id', $movieID)->exists();
    }
}
