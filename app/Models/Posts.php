<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Posts
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $slug
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $view_count
 * @property integer $vote_count
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereVoteCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Posts extends Model
{
    use SoftDeletes;
    //
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable=[
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
        if (! $this->exists) {
            $this->attributes['slug'] = str_slug($value);
        }
    }
    
}
