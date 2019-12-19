<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }
    public function addComment($content, $user_id)
    {
    	$this->comments()->create(compact('content', 'user_id'));
    }
}
