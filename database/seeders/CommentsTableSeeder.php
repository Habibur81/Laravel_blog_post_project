<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts = BlogPost::all();
        $users = User::all();


        if( $posts->count() === 0  || $users->count() === 0){

            $this->command->info('there are no blog posts, so no comments will be added');

            return;
        }


        $CommentCount = (int) $this->command->ask('How many comments count like?', 20);


        Comment::factory()->count($CommentCount)->make()->each(function($comment) use ($posts, $users){

            $comment->commentable_id = $posts->random()->id;

            $comment->commentable_type = 'App\Models\BlogPost';

            $comment->user_id = $users->random()->id;

            $comment->save();
       });



        Comment::factory()->count($CommentCount)->make()->each(function($comment) use ( $users){

            $comment->commentable_id = $users->random()->id;

            $comment->commentable_type = 'App\Models\User';

            $comment->user_id = $users->random()->id;

            $comment->save();
        });



    }
}
