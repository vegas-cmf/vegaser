<?php
/**
 * This file is part of Vegas package
 *
 * @author Jaroslaw <Macko>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Auth\Services;

use User\Models\User;

class Auth implements \Phalcon\DI\InjectionAwareInterface
{
    use \Vegas\DI\InjectionAwareTrait;

    public function login($email, $password) 
    {
        $user = new User();
        if ($user->getIdentity() != $email) {
            throw new \Vegas\Security\Authentication\Exception\InvalidCredentialException();
        }
        $this->di->get('auth')->authenticate($user, $password);
    }

    public function logout() 
    {
        $auth = $this->di->get('auth');
        $auth->logout();
    }
}
