<?php

namespace App\Shared;

use Vegas\Di\Injector\SharedServiceProviderInterface;

/**
 * Class ViewCache
 * @package App\Shared
 */
class ViewCache implements SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'viewCache';
    }

    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function getProvider(\Phalcon\DiInterface $di)
    {
        return function() use ($di)
        {
            // Cache data for one day by default
            $frontCache = new \Phalcon\Cache\Frontend\Output([
                'lifetime' => 86400
            ]);

            // File backend settings
            $cache = new \Phalcon\Cache\Backend\File($frontCache, [
                'cacheDir' => $di->get('config')->application->view->cacheDir
            ]);

            return $cache;
        };
    }
}