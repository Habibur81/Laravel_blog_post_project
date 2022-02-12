<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $BlogPostCount = (int) $this->command->ask('How many blog posts count like?', 10);

        $users = User::all();

        BlogPost::factory($BlogPostCount)->make()->each(function($post) use ($users){
            $post->user_id = $users->random()->id;
            $post->save();
       }); //work this code properly

    }
}
