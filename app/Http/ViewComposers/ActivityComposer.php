<?php

namespace App\Http\ViewComposers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer
{

    public function compose( View $view )
    {

        $MostCommented = Cache::remember('MostCommented', 60, function () {
            return  BlogPost::mostCommented()->take(5)->get();
        });

        $mostActiveUser = Cache::remember('mostActiveUser', 60, function () {
            return User::withMostCommentBlogPosts()->take(5)->get();
        });

        $mostActiveLastMonth = Cache::remember('mostActiveLastMonth', 60, function () {
            return  User::withBlogPostsLastMonth()->take(5)->get();
        });

        $view->with('MostCommented', $MostCommented);

        $view->with('mostActiveUser', $mostActiveUser);

        $view->with('mostActiveLastMonth', $mostActiveLastMonth);

    }

}
