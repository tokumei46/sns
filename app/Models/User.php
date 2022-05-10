<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Models\Reply;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'comment',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function loadRelationshipCounts()
    {
        $this->loadCount('posts', 'followings', 'followers', 'favorites');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    public function favorites() {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withTimestamps();
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function follow($userId) {
        $foll = $this->is_following($userId);
        $llfo = $this->id == $userId;

        if($foll || $llfo) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId) {
        $foll = $this->is_following($userId);
        $llfo = $this->id == $userId;

        if($foll && !$llfo) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    public function is_following($userId) {
        return $this->followings()->where('follow_id', $userId)->exists();
    }

    public function free_posts() {
        $userIds = $this->followings()->pluck('users.id')->toArray();
        $userIds[] = $this->id;
        return post::whereIn('user_id', $userIds);
    }

    public function favorite($userFavo) {
        $isx = $this->is_favorite($userFavo);
        $itx = $this->id == $userFavo;

        if($isx || $itx) {
            return false;
        } else {
            $this->favorites()->attach($userFavo);
            return true;
        }
    }

    public function unfavorite($userFavo) {
        $isx = $this->is_favorite($userFavo);
        $itx = $this->id == $userFavo;

        if($isx || $itx) {
            $this->favorites()->detach($userFavo);
            return true;
        } else {
            return false;
        }
    }

    public function is_favorite($userFavo) {
        return $this->favorites()->where('post_id', $userFavo)->exists();
    }
}
