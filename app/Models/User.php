<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const LOCALES =[

        'en' => 'English',
        'es' => 'Espanol',
        'de' => 'Deutsch',

    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function blogPost()
    {
        return $this->hasMany('App\Models\BlogPost');

    }//relationship with blogposts models


    public function comment()
    {
        return $this->hasMany('App\Models\Comment');

    }//relationship with comments models

    public function commentsOn()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();

    }//relation with Comment Model

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }//this relationship with Image models this the oneToOne morph relationship



    public function scopeWithMostCommentBlogPosts( Builder $query )
    {
        return $query->withCount('blogPost')->orderBy('blog_post_count', 'desc');

    }//Local query scope Build


    public function scopeWithBlogPostsLastMonth( Builder $query )
    {
        return $query->withCount(['blogPost' => function( Builder $query )
        {

            $query->whereBetween( static::CREATED_AT, [now()->subMonths(1), now() ]);

        }])->has('blogPost', '>=', 2 )->orderBy('blog_post_count', 'desc');

    }//Local query scope Build

    public function scopeThatHasCommentedOnPost( Builder $query, BlogPost $post )
    {

        return $query->whereHas('comment', function($query) use($post){

            return $query->where('commentable_id', '=', $post->id)
                    ->where('commentable_type', '=', BlogPost::class);

        });

    }

    public function scopeThatIsAnAdmin( Builder $query)
    {
        return $query->where('is_admin', true);
    }



}
