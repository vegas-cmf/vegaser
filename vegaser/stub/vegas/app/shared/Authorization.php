<?php

namespace App\Shared;

use Phalcon\DiInterface;
use Phalcon\Session\Bag;
use Vegas\Di\Injector\SharedServiceProviderInterface;

/**
 * Class Authorization
 * @package App\Shared
 */
class Authorization implements SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'authorization';
    }

    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function getProvider(\Phalcon\DiInterface $di)
    {
        return function() use ($di)
        {

            $passwordAdapter = new \Vegas\Security\Password\Adapter\Standard($di);
            $adapter = new \Vegas\Security\Authentication\Adapter\Standard($passwordAdapter);
            $adapter->setSessionStorage(new Bag('authorization'));

            return new \Vegas\Security\Authentication($adapter);
        };
    }
}