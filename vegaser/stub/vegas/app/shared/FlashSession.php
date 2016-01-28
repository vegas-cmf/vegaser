<?php

namespace App\Shared;

use Vegas\Di\Injector\SharedServiceProviderInterface;

/**
 * Class Flash
 * @package App\Shared
 */
class FlashSession implements SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'flashSession';
    }

    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function getProvider(\Phalcon\DiInterface $di)
    {
        return function() use ($di)
        {
            return new \Phalcon\Flash\Session(
                [
                    'error' => 'alert alert-danger alert-block fade in',
                    'success' => 'alert alert-success alert-block fade in',
                    'notice' => 'alert alert-info alert-block fade in'
                ]
            );
        };
    }
}