<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Movie
 *
 * @property int $id
 * @property string|null $title
 * @property int $user_id
 * @property string $youtube_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereYoutubeId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|Movie onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Movie withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Movie withoutTrashed()
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $favoriteUsers
 * @property-read int|null $favorite_users_count
 * @property int $favorite_flag
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereFavoriteFlag($value)
 */
class Movie extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'movie_id', 'user_id')->withTimestamps();
    }
}
