<?php

namespace App\Shared;

use Phalcon\Session\Adapter\Files;
use Vegas\Di\Injector\SharedServiceProviderInterface;

/**
 * Class Session
 * @package App\Shared
 */
class Session implements SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'session';
    }

    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function getProvider(\Phalcon\DiInterface $di)
    {
        return function() use ($di)
        {
            $session = new Files();
            $session->start();

            return $session;
        };
    }
}