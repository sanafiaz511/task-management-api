<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    public static function remember($key, $ttl, $callback)
    {
        return Cache::remember($key, $ttl, $callback);
    }

    public static function forget($key)
    {
        Cache::forget($key);
    }
}