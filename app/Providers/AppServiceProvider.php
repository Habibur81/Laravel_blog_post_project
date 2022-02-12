<?php

namespace App\Providers;

use App\Http\ViewComposers\ActivityComposer;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Observers\BlogPostObserver;
use App\Observers\CommentObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\Counter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Blade::component('components.badge', badge::class);

        // Blade::component('components.updated', updated::class);

        // Blade::component('components.card', updated::class);

        // Blade::component('components.tags', tags::class);

        // Blade::component('components.errors', errors::class);
        //this errors register component

        // View()->composer( '*', ActivityComposer::class);
        //use this for all single blade template

        View()->composer( ['posts.index', 'posts.show'], ActivityComposer::class);
        //composer registration for blade template


        BlogPost::observe(BlogPostObserver::class);
        //observer class registration here for BlogPostObserver observer work properly

        Comment::observe(CommentObserver::class);
        //observer class registration here for CommentObserver observer work properly



        $this->app->singleton(Counter::class, function($app){
            return new Counter(
                $app->make('Illuminate\Contracts\Cache\Factory'),
                $app->make('Illuminate\Contracts\Session\Session'),
                env('COUNTER_TIMEOUT')
            );
        });

        $this->app->bind(
            'App\contracts\counterContract',
            Counter::class
        );

        //$this->app->when(Counter::class)
        //->needs('$timeout')
        //->give(env('COUNTER_TIMEOUT'));



    }//registration component used korte parini ami shikhte hobe



}
