<?php

namespace App\Models;

class Category extends IModel
{
    //use ORM Cache
    protected $needCache = true;
    //
    protected $fillable = ['category_name'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
