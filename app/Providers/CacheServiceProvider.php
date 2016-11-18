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
     * 根据配置文件注册应用程序的缓存服务
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(SiteCacheInterface::class, function () {
            if (config('cache.enable') == 'true') {
                return new RedisCache();
            } else {
                return new NoCache();
            }
        });
    }

    /**
     * 在必要的时候获取服务提供者
     * @return array
     */
    public function provides()
    {
        return [SiteCacheInterface::class];
    }
}
