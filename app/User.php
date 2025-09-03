<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')
                    ->withTimestamps();
    }

    public function favorite($movieId)
    {
        if (! $this->isFavorite($movieId)) { // 追加されていないときにだけ attach
            $this->favorites()->attach($movieId);
            return true;
        }
        return false;
    }

    public function unfavorite($movieId)
    {
        if ($this->isFavorite($movieId)) {
            $this->favorites()->detach($movieId);
            return true;
        }
        return false;
    }

    public function isFavorite($movieId)
    {
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }
}