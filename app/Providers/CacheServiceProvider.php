<?php

namespace App\Providers;

use App\Helpers\Caches\RedisCache;
use App\Helpers\Caches\NoCache;
use Illuminate\Support\ServiceProvider;
use App\Contracts\SiteCacheInterface;

class CacheServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $cache_interface_name = SiteCacheInterface::class;
        $this->app->bind($cache_interface_name, function () {
            if (config('cache.enable') == 'true') {
                return new RedisCache();
            } else {
                return new NoCache();
            }
        });
    }

    public function provides()
    {
        $cache_interface_name = SiteCacheInterface::class;
        return [$cache_interface_name];
    }
}
