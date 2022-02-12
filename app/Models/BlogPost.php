<?php

namespace App\Models;

use App\Scopes\deleteAdminScope;
use App\Traits\taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogPost extends Model
{
    use HasFactory;

    use SoftDeletes, taggable;

    // protected $table = 'blogposts';
    protected $fillable = ['title', 'content', 'user_id']; //mess assignmet proccess


    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }//this relationship with Image models this the oneToOne morph relationship


    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();

    }//relation with Comment Model


    public function User()
    {
        return $this->belongsTo('App\Models\User');

    }//relation with User Model

    // public function tags()
    // {
    //     return $this->morphToMany('App\Models\Tag', 'taggable')->withTimestamps();

    // }//ManyToMany polymorphic relationship with Tag model


    public function scopeLatest( Builder $query )
    {
        $query->orderBy( static::CREATED_AT, 'DESC' );

    }//local query scope method

    public function scopeMostCommented( Builder $query )
    {

        return $query->withCount('comments')->orderBy('comments_count', 'desc');

    }//local query scope method


    public static function boot()
    {

        static::addGlobalScope(new deleteAdminScope);//this  is global query scope line used for show delete post by admin

        parent::boot();

    }


}
