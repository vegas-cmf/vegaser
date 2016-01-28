<?php
/**
 * This file is part of Vegas package
 *
 * @author Mateusz Aniolek <mateusz.aniolek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Auth\Controller;

use Vegas\Mvc\ControllerAbstract;

class AuthController extends ControllerAbstract
{
    public function loginAction()
    {
        if($this->request->isPost()) {
            $postParams = $this->request->getPost();

            try {
                $this->getDI()->get('\Auth\Service\Auth')->login($postParams['email'], $postParams['password']);

            } catch (\Exception $ex) {
                $this->flashSession->error($ex->getMessage());
                return $this->response->redirect('/login');
            }

            return $this->response->redirect('/test');
        }
    }

    public function registerAction()
    {
        if($this->request->isPost()) {
            $postParams = $this->request->getPost();

            try {
                $this->getDI()->get('\Auth\Service\Auth')->register($postParams['email'], $postParams['password']);

            } catch (\Exception $ex) {
                $this->flashSession->error($ex->getMessage());
                return $this->response->redirect('/register');
            }

            return $this->response->redirect('/login');
        }
    }

    public function logoutAction()
    {
        $this->getDI()->get('\Auth\Service\Auth')->logout();

        return $this->response->redirect('/login');
    }
}