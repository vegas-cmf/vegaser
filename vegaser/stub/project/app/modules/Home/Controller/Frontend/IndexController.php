<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Home\Controller\Frontend;

use Home\Model\Test;

class IndexController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        /** @var \Home\Model\Dao\Test $dao */
        $dao = $this->dao->get('Home\Model\Test');

        $this->view->inactive = $dao->findInActive();
        $this->view->active = $dao->findActive();
    }

    public function ipAction()
    {
        $this->response->setHeader('Content-Type', 'application/json');
        $this->response->setJsonContent(['test' => 1]);
        return $this->response;
    }
}