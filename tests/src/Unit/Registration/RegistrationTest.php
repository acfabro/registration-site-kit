<?php

namespace Acfabro\RegistrationSiteKitTests\Unit\Registration;

use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationFactory;
use Acfabro\RegistrationSiteKitTests\RskTestCase;

class RegistrationTest extends RskTestCase
{
    use Setup;

    public function testTrue()
    {
        $this->assertTrue(true);
    }

    public function testCreatedObject()
    {
        $user = $this->makeUser();
        $event = $this->makeEvent();
        $reg = $this->makeReg($user, $event);

        $this->assertSame($this->defaultRegData['firstName'], $reg->firstName);
        $this->assertSame($this->defaultRegData['lastName'], $reg->lastName);
        $this->assertSame($this->defaultRegData['email'], $reg->email);
    }

    public function testUserId()
    {
        $user = $this->makeUser();
        $event = $this->makeEvent();
        $reg = $this->makeReg($user, $event);

        $this->assertSame($user->id(), $reg->userId);
    }

    public function testNewRegistrationIdNotEmpty()
    {
        $user = $this->makeUser();
        $event = $this->makeEvent();
        $reg = $this->makeReg($user, $event);

        $this->assertNotEmpty($reg->id());
    }

    public function testNameNotEmpty()
    {
        $user = $this->makeUser();
        $event = $this->makeEvent();
        $reg = $this->makeReg($user, $event);

        $this->assertNotEmpty($reg->name());
    }

    public function testUserNotEmpty()
    {
        $user = $this->makeUser();
        $event = $this->makeEvent();
        $reg = $this->makeReg($user, $event);

        $this->assertSame($user->id(), $reg->userId());
    }

    public function testEmailNotEmpty()
    {
        $user = $this->makeUser();
        $event = $this->makeEvent();
        $reg = $this->makeReg($user, $event);

        $this->assertSame($this->defaultRegData['email'], $reg->email());
    }

    public function testInitDataSame()
    {
        $user = $this->makeUser();
        $event = $this->makeEvent();
        $regFactory = app(RegistrationFactory::class);

        // data only
        $data = [
            'firstName' => 'John',
            'lastName' => 'Smith',
            'email' => 'sample@email.com',
        ];

        // inject user and event
        $reg = $regFactory->make($data, [
            'user' => $user,
            'event' => $event
        ]);

        // make the source array
        $source = array_merge($data, [
            'userId' => $user->id,
            'eventId' => $event->id,
        ]);

        // make the dest array
        $dataNew = $reg->toArray();
        unset($dataNew['id']); // because we dont know the new id

        $this->assertSame($source, $dataNew);
    }

}
