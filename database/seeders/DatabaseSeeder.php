<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //  DB::table('users')->insert([
        //     'name' => 'Habib',
        //     'email' => 'mdhabiburr375@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('12345678'), // password
        //     'remember_token' => Str::random(10),
        // ]);

        //dd( get_class($defaultUser), get_class($other) ); check this line

        //$users = $otherUsers->concat([$defaultUser]);
        //dd($users->count() ); check this line

        if($this->command->confirm('Do you want to refresh the databases?')){
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refreshed');
        }//work successfully

        $this->call([

            UsersTableSeeder::class,
            BlogPostsTableSeeder::class,
            CommentsTableSeeder::class,
            TagsTableSeeder::class,
            BlogPostTagTableSeeder::class,


        ]);


    }

}
