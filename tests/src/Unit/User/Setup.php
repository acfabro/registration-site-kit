<?php


namespace Acfabro\RegistrationSiteKitTests\Unit\User;


use Acfabro\RegistrationSiteKit\Entities\User\User;
use Acfabro\RegistrationSiteKit\Util\Id\UuidIdGenerator;

trait Setup
{
    protected $defaultUserData = [
        'username' => 'sampleuser',
        'email' => 'email@email.com',
    ];

    protected function makeUser($data = null)
    {
        $data = $data? $data: $this->defaultUserData;
        return User::factory(new UuidIdGenerator(), $data);
    }

}