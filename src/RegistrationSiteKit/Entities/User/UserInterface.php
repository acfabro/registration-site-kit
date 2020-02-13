<?php

namespace Acfabro\RegistrationSiteKit\Entities\User;


/**
 * Interface UserInterface
 * @package Acfabro\RegistrationSiteKit\Entities\User
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $status
 */
interface UserInterface
{
    /**
     * User ID
     * @return mixed
     */
    public function id();

    /**
     * Registered email address
     * @return mixed
     */
    public function email();

    /**
     * Username
     * @return mixed
     */
    public function username();

    /**
     * Status
     * @return mixed
     */
    public function status();

}
