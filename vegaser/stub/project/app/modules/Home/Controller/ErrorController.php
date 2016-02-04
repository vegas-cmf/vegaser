<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Home\Controller;

use Vegas\Mvc\ControllerAbstract;

class ErrorController extends ControllerAbstract
{
    public function notfoundAction()
    {
        return $this->response->setStatusCode(404)->send();
    }
}