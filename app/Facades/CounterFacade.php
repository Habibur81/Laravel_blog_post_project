<?php
    namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CounterFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'App\contracts\counterContract';
    }
}
