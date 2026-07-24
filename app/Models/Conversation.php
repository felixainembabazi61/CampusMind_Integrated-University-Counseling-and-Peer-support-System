<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    protected $fillable = ['user_id', 'counselor_id'];
public function user() {
    return $this->belongsTo(User::class, 'user_id');
}
public function counselor() {
    return $this->belongsTo(User::class, 'counselor_id');
}
public function messages() {
    return $this->hasMany(Message::class);
}
}
