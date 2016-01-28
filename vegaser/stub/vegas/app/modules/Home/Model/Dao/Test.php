<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Home\Model\Dao;

use Vegas\Db\Dao\DefaultDao;
use \Vegas\ODM\Collection;

/**
 * Class Test
 * @package Test\Model
 */
class Test extends DefaultDao
{
    public function findActive()
    {
        return $this->find([
            [
                'isActive' => true
            ]
        ]);
    }

    public function findInActive()
    {
        return $this->find([
            [
                'isActive' => false
            ]
        ]);
    }

}