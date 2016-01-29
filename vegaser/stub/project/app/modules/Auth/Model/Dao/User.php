<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Auth\Model\Dao;

use Vegas\Db\Dao\DefaultDao;
use \Vegas\ODM\Collection;

/**
 * Class User
 * @package Auth\Model\Dao
 */
class User extends DefaultDao
{
    /**
     * @return \Auth\Model\User
     */
    public function findLast()
    {
        return $this->findFirst([
            'conditions' => [],
            'sort' => [
                'created_at' => -1
            ],
            'limit' => 1
        ]);
    }

}