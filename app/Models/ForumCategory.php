<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    //
    public function forumPosts() {
    return $this->hasMany(ForumPost::class);
}
// app/Models/ForumCategory.php

public function latestPost()
{
    return $this->hasOne(ForumPost::class)->latestOfMany();
}
}
