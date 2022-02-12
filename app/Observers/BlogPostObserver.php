<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Cache;

class BlogPostObserver
{


    public function updating(BlogPost $blogPost)
    {
        Cache::forget( "blog-post-{$blogPost->id}" );
    }//used to cache remove


    public function deleting(BlogPost $blogPost)
    {
        // dd('I am delete');

        $blogPost->comments()->delete(); // work successfully

        Cache::forget( "blog-post-{$blogPost->id}" );

    }//used for soft delete


    public function restoring(BlogPost $blogPost)
    {
        $blogPost->comments()->restore(); //work successfully
    }//used for soft storing


}
