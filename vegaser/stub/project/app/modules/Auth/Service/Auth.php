<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Auth\Service;

use Auth\Model\User;
use Phalcon\DI\InjectionAwareInterface;
use Vegas\Di\InjectionAwareTrait;
use Vegas\Security\Authentication;

class Auth implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    public function login($email, $password)
    {
        $userModel = User::findFirst([[
            'email' => $email
        ]]);

        if(!$userModel) {
            throw new Authentication\Exception\InvalidCredentialException;
        }

        /** @var Authentication $authorizationService */
        $authorizationService = $this->getDI()->get('authorization');

        return $authorizationService->authenticate($userModel, $password);
    }

    public function register($email, $password)
    {
        $userCount = User::count([[
            'email' => $email
        ]]);

        if($userCount != 0) {
            throw new \Exception('Email already exists');
        }

        $user = new \Auth\Model\User();
        $user->email = $email;
        $user->raw_password = $password;
        $user->save();

        return $user;
    }

    public function logout()
    {
        /** @var Authentication $authorizationService */
        $authorizationService = $this->getDI()->get('authorization');
        $authorizationService->logout();
    }



}