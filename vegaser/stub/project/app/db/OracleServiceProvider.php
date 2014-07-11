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
use Vegas\DI\ServiceProviderInterface;
use Phalcon\Mvc\Url as UrlResolver;

class DbServiceProvider implements ServiceProviderInterface
{
    const SERVICE_NAME = 'db';

    /**
     * {@inheritdoc}
     * @link http://phalcon.agent-j.ru/en/1.3.0/Phalcon/Db/Adapter/Pdo/Oracle
     */
    public function register(DiInterface $di)
    {
        $di->set(self::SERVICE_NAME, function () use ($di) {
            $config = $di->get('config');
            $di->set('db', function () use ($config) {
                return new Phalcon\Db\Adapter\Pdo\Oracle(array(
                    "host" => $config->db->host,
                    "dbname" => $config->db->dbname,
                    "port" => $config->db->port,
                    "username" => $config->db->username,
                    "password" => $config->db->password
                ));
            });
        }, true);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            ModelsManagerServiceProvider::SERVICE_NAME
        );
    }
} 