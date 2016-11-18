<?php

namespace App\Models;


class Tag extends IModel
{
    //use ORM Cache
    protected $needCache = true;
    //
    protected $fillable = ['tag_name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
