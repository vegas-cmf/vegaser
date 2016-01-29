<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Auth\Model;

use Phalcon\Security;
use \Vegas\ODM\Collection;
use Vegas\Security\Authentication\GenericUserInterface;

/**
 * Class User
 * @package Auth\Model
 */
class User extends Collection implements GenericUserInterface
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $raw_password;

    public function beforeSave()
    {
        if(!empty($this->raw_password)) {
            $this->password = $this->getDI()->get('security')->hash($this->raw_password);
            unset($this->raw_password);
        }
    }

    public function getSource()
    {
        return 'vegas_app_users';
    }

    /**
     * Return user identity
     *
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->email;
    }

    /**
     * Returns hashed password
     *
     * @return mixed
     */
    public function getCredential()
    {
        return $this->password;
    }

    /**
     * Returns additional attributes
     *
     * @return mixed
     */
    public function getAttributes()
    {
        $result = $this->toArray();
        if(isset($result['password'])) {
            unset($result['password']);
        }

        return $result;
    }
}