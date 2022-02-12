<?php
    namespace App\contracts;

interface counterContract
{
    public function increment(string $key, array $tags=null): int;
}
