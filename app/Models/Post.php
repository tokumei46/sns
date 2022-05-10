<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'post_id',
        'content',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }

    public function replies() {
        return $this->hasMany(Reply::class, 'comment');
    }
}
