<?php
namespace App\Shared;

use Phalcon\DiInterface;
use Vegas\Di\Injector\SharedServiceProviderInterface;

/**
 * Class Mongo
 * @package App\Shared
 */
class Mongo implements SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'mongo';
    }
    /**
     * {@inheritdoc}
     */
    public function getProvider(DiInterface $di)
    {
        return function() use ($di)
        {
            $mongo = new \MongoClient();

            return $mongo->selectDb($di->get('config')->mongo->db);
        };
    }
}