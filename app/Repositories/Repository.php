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

    /**
     * @return \App\Contracts\SiteCacheInterface
     */
    private function getCacheObj()
    {
        $cache_interface_name = SiteCacheInterface::class;
        if (null === $this->siteCache) {
            $this->siteCache = app($cache_interface_name);
        }
        return $this->siteCache;
    }

    public function getTest()
    {
        $this->getCacheObj()->getKey();
    }

}