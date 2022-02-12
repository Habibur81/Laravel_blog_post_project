<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function blogposts()
    {
        // return $this->belongsToMany('App\Models\BlogPost')->withTimestamps()->as('tagged');
        return $this->morphedByMany('App\Models\BlogPost', 'taggable')->withTimestamps()->as('tagged');

    }//ManyToMany polymorphic relationship with BlogPost model

    public function comments()
    {

        return $this->morphedByMany('App\Models\Comment', 'taggable')->withTimestamps()->as('tagged');

    }//ManyToMany polymorphic relationship with Comment model

}
