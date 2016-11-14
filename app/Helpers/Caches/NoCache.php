<?php
/**
 * No Cache status for Repository
 * Date: 2016/11/14 0014
 * Time: 15:41
 */

namespace App\Helpers\Caches;

use App\Contracts\SiteCacheInterface;

class NoCache implements SiteCacheInterface
{

    public function getKey()
    {
        // TODO: Implement getKey() method.
        echo 'no cache';
    }

    public function setKey()
    {
        // TODO: Implement setKey() method.
    }
}