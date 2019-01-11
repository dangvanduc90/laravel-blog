<?php

namespace App;

use App\Scopes\PostUserScope;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function user()
    {
        // Default Models if no user is attached to the post
        return $this->belongsTo('App\User')->withDefault(function ($user) {
            $user->name = 'Guest Author';
        });
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PostUserScope());
    }
}
