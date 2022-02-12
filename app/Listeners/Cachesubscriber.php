<?php

namespace App\Listeners;

use Illuminate\Cache\Events\CacheHit;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Support\Facades\Log;

class Cachesubscriber
{
    public function handleCacheHit( CacheHit $event)
    {
        Log::info("{ $event->key } cache hit ");
    }

    public function handleCacheMissed( CacheMissed $event)
    {
        Log::info("{ $event->key } cache miss ");
    }

    public function subscribe($event)
    {
        $event->listen(
            CacheHit::class,
            'App\Listeners\Cachesubscriber@handleCacheHit'
        );

        $event->listen(
            CacheMissed::class,
            'App\Listeners\Cachesubscriber@handleCacheMissed'
        );

    }
}
