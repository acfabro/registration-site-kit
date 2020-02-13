<?php

namespace Acfabro\RegistrationSiteKit\Entities\User;


use Acfabro\RegistrationSiteKit\Core\Entity\Entity;
use Acfabro\RegistrationSiteKit\Core\Entity\EntityInterface;
use Acfabro\RegistrationSiteKit\Util\Id\IdGeneratorInterface as IdGenerator;

/**
 * Class User
 *
 * User value object
 *
 * @package Acfabro\RegistrationSiteKit\Entities\User
 */
class User extends Entity implements UserInterface
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_UNVERIFIED = 'unverified';

    protected $fillable = [
        'id', 'username', 'email', 'status',
    ];

    public function username()
    {
        return $this->username;
    }

    public function status()
    {
        return $this->status;
    }

    public function email()
    {
        return $this->email;
    }

    public function id()
    {
        return $this->id;
    }

}
