<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace %%module_name%%\Component;


use Vegas\Mvc\Component\ComponentAbstract;

class Table extends ComponentAbstract
{
    protected $initCount = 0;

    public function initialize()
    {
        $increment = ++$this->initCount;
        $this->setViewParam('initCounter', $increment);

        parent::initialize();
    }

    public function datagrid()
    {
        return $this->getRender('datagrid');
    }
}