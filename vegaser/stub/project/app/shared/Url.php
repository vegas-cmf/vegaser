<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Phalcon\DiInterface;
use Phalcon\Mvc\Url as UrlResolver;
use \Vegas\Di\Injector\SharedServiceProviderInterface;

class Url implements SharedServiceProviderInterface
{
    const SERVICE_NAME = 'url';

    /**
     * @return string
     */
    public function getName()
    {
        return self::SERVICE_NAME;
    }

    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function getProvider(\Phalcon\DiInterface $di)
    {
        return function() use ($di)
        {
            $url = new UrlResolver();
            $url->setBaseUri($di->get('config')->application->baseUri);

            return $url;
        };

    }
}