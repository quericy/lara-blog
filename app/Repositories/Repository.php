<?php
/**
 * abstract Repository
 * Date: 2016/11/14 0014
 * Time: 15:18
 */

namespace App\Repositories;

use App\Contracts\SiteCacheInterface;

abstract class Repository
{
    private $siteCache;

    public abstract function model();

    public abstract function tag();

    /**
     * 按需获取缓存接口实现的实例
     * @return \App\Contracts\SiteCacheInterface
     */
    public function CacheObj()
    {
        if (null === $this->siteCache) {
            $this->siteCache = app(SiteCacheInterface::class);
        }
        return $this->siteCache;
    }



}