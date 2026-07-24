<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    //
    protected $fillable = ['user_id', 'forum_category_id', 'title', 'body', 'is_private'];

public function user() {
    return $this->belongsTo(User::class);
}
public function category() {
    return $this->belongsTo(ForumCategory::class);
}
public function comments() {
    return $this->hasMany(ForumComment::class);
}
public function reactions() {
    return $this->morphMany(Reaction::class, 'reactable');
}
// Scope: show only posts the current user is allowed to see
public function scopeVisibleTo($query, $user = null) {
    if (!$user) {
        return $query->where('is_private', false);
    }
    if ($user->hasRole('counselor') || $user->hasRole('admin')) {
        return $query; // counselors/admin see all
    }
    return $query->where(function($q) use ($user) {
        $q->where('is_private', false)
          ->orWhere('user_id', $user->id);
    });
}
}
