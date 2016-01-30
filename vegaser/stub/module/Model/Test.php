<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace %%module_name%%\Model;

use \Vegas\ODM\Collection;

/**
 * Class Test
 * @package Test\Model
 */
class %%module_name%% extends Collection
{
    /**
     * @var \MongoDate
     */
    protected $createdAt;

    /**
     * @return \MongoDate
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getSource()
    {
        return 'vegas_%%module_name%%';
    }

}