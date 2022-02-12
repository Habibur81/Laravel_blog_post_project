<?php

namespace App\Observers;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function creating(Comment $comment)
    {
        if( $comment->commentable_type === BlogPost::class ){

            // dd('I am created');

            Cache::forget( "blog-post-{$comment->commentable_id}" );

            Cache::forget( 'MostCommented' );

        }
    }



}
