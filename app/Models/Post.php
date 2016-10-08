<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = [
        'title',
        'content',
        'slug',
        'user_id',
        'category_id',
        'view_count',
        'vote_count',
        'status'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        //操作title时未指定slug则自动生成
        if (!$this->exists) {
            $this->attributes['slug'] = str_slug($value);
        }
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
