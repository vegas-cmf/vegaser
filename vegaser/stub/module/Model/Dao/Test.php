<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace %%module_name%%\Model\Dao;

use Vegas\Db\Dao\DefaultDao;
use \Vegas\ODM\Collection;

/**
 * Class %%module_name%%
 * @package %%module_name%%\Model
 */
class %%module_name%% extends DefaultDao
{
    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->find();
    }
}