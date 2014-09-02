<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Auth\Models;

use Vegas\Security\Authentication\GenericUserInterface;

class BaseUser implements GenericUserInterface
{

    public function getIdentity()
    {
        return 'user@vegasdemo.com';
    }

    public function getCredential()
    {
        return \Phalcon\DI::getDefault()->get('userPasswordManager')->encryptPassword('p@$$w0rD');
    }

    public function getAttributes()
    {
        $userData = array(
            'email' => $this->getIdentity(),
            'name' => 'Vegas User',
            'id' => 1
        );

        return $userData;
    }
}
 
