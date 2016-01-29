<?php
/**
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 */

namespace App\Shared;

use Vegas\Di\Injector\SharedServiceProviderInterface;

class CollectionManager implements SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'collectionManager';
    }

    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function getProvider(\Phalcon\DiInterface $di)
    {
        return function() use ($di)
        {
            return new \Phalcon\Mvc\Collection\Manager();
        };
    }
}