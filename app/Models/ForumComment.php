<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    //
    protected $fillable = ['user_id', 'forum_post_id', 'body'];

public function user() {
    return $this->belongsTo(User::class);
}
public function post() {
    return $this->belongsTo(ForumPost::class);
}
public function reactions() {
    return $this->morphMany(Reaction::class, 'reactable');
}
}
