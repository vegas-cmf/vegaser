<?php

namespace App\Shared;

use Phalcon\DiInterface;
use Vegas\Di\Injector\SharedServiceProviderInterface;

/**
 * Class Dao
 * @package App\Shared
 */
class Dao implements SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'dao';
    }

    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function getProvider(\Phalcon\DiInterface $di)
    {
        return function() use ($di)
        {
            $dao = new \Vegas\Db\Dao\Manager;
            $dao->setDI($di);

            return $dao;
        };
    }
}