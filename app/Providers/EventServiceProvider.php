<?php

namespace App\Providers;

use App\Events\BlogPostPosted;
use App\Events\CommentPosted;
use App\Listeners\Cachesubscriber;
use App\Listeners\NotifyAdminWhenBlogPostCreated;
use App\Listeners\NotifyUsersAboutComment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        CommentPosted::class =>[
            NotifyUsersAboutComment::class,
        ],

        BlogPostPosted::class =>[
            NotifyAdminWhenBlogPostCreated::class
        ],

    ];

    protected $subscribe = [

        Cachesubscriber::class

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
