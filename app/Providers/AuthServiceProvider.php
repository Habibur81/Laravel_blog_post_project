<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy', // eta dewya ache example hisabe eivake likhte policy jon
        'App\Models\blogPost' => 'App\Policies\BlogPostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('home.secret', function($user){

            return $user->is_admin;

        });

        // Gate::define('update-post', function( $user, $post  ){

        //    return $user->id == $post->user_id;

        // });
        //Gate::allows('update-post', $post);
        //$this->authorize('update-post', $post);



        // Gate::define('delete-post', function( $user, $post  ){

        //     return $user->id == $post->user_id;

        // });



        // Gate::define('posts.update', 'App\Policies\BlogPostPolicy@update');
        // Gate::define('posts.delete', 'App\Policies\BlogPostPolicy@delete');


        // Gate::resource('posts', 'App\Policies\BlogPostPolicy');
        //this gate work create update delete all methods
        //comments.create comments.update etc kora



        Gate::before( function($user, $ability){

            if( $user->is_admin && in_array($ability, ['update', 'delete'] )){
                return true;
            }

        });



        // Gate::after( function($user, $ability, $result){

        //     if( $user->is_admin ){
        //         return true;
        //     }
        // });



    }
}
