<?php

namespace Acfabro\RegistrationSiteKitTests\Unit\User;


use Acfabro\RegistrationSiteKit\Entities\User\User;
use Acfabro\RegistrationSiteKit\Entities\User\UserFactory;
use Acfabro\RegistrationSiteKit\Util\Id\UuidIdGenerator;
use Acfabro\RegistrationSiteKitTests\RskTestCase;
use function Acfabro\RegistrationSiteKit\ServiceProviders\entity;

class UserTest extends RskTestCase
{

    protected $data = [
        'username' => 'mylogin',
        'email' => 'john@email.com',
        'status' => User::STATUS_ACTIVE,
    ];

    public function testCanMakeWithNewData()
    {
        $user = entity(UserFactory::class, $this->data);

        $this->assertNotEmpty($user->id());
    }

    public function testCanMakeExistingData()
    {
        $data = $this->data;
        $data['id'] = (new UuidIdGenerator())->generate();
        $user = entity(UserFactory::class, $data);

        $this->assertSame($data['id'], $user->id());
    }

    public function testSameData()
    {
        $data = $this->data;
        $data['id'] = (new UuidIdGenerator())->generate();
        $user = entity(UserFactory::class, $data);

        $this->assertSame($data, $user->toArray());
    }

}
