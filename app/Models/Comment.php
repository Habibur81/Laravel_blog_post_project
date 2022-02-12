<?php

namespace App\Models;


use App\Traits\taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'content' ];

    protected $hidden = ['delete_at', 'commentable_type', 'commentable_id'];

    use SoftDeletes, taggable;

    // blog_post_id
    public function commentable()
    {
        // return $this->belongsTo('App\BlogPost', 'post_id', 'blog_post_id');
        return $this->morphTo();

    }//relation with BlogPost Model

    public function user()
    {
        // return $this->belongsTo('App\BlogPost', 'post_id', 'blog_post_id');
        return $this->belongsTo('App\Models\User');

    }//relation with User Model


    // public function tags()
    // {
    //     return $this->morphToMany('App\Models\Tag', 'taggable')->withTimestamps();

    // }//ManyToMany polymorphic relationship with Tag model


    public function scopeLatest( Builder $query )
    {
        return $query->orderBy( static::CREATED_AT, 'DESC' );
    }//local query scope method



}
