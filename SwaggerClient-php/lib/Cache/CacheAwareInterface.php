<?php

namespace SalesForce\MarketingCloud\PHPSDK\Cache;

use Psr\Cache\CacheItemPoolInterface;

/**
 * Interface CacheAwareInterface
 *
 * @package SalesForce\MarketingCloud\PHPSDK\Cache
 */
interface CacheAwareInterface
{
    /**
     * @param CacheItemPoolInterface $cache
     * @return mixed
     */
    public function setCache(CacheItemPoolInterface $cache);
}