<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    //(中略)
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id')->withTimestamps();
    }
    public function favorite($movieId)
    {
        $exist = $this->isFavorite($movieId);
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($movieId);
            return true;
        }
    }
    public function unfavorite($movieId)
    {
        $exist = $this->isFavorite($movieId);
        if ($exist) {
            $this->favorites()->detach($movieId);
            return true;
        } else {
            return false;
        }
    }
    public function isFavorite($movieId)
    {
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }
}