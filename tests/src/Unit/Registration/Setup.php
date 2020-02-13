<?php


namespace Acfabro\RegistrationSiteKitTests\Unit\Registration;


use Acfabro\RegistrationSiteKit\Entities\Event\EventFactory;
use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationFactory;
use Acfabro\RegistrationSiteKit\Entities\User\UserFactory;
use function Acfabro\RegistrationSiteKit\ServiceProviders\entity;

trait Setup
{
    protected $defaultEventData = [
        'name' => 'Nine-Nine!',
        'description' => 'The biggest event for Nine-Nine fans',
        'start' => '',
        'end' => '',
        'status'
    ];

    protected $defaultRegData = [
        'firstName' => 'John',
        'lastName' => 'Smith',
        'email' => 'email@email.com',
    ];

    protected $defaultUserData = [
        'username' => 'sampleuser',
        'email' => 'email@email.com',
    ];

    protected function makeUser($data = null)
    {
        $data = $data? $data: $this->defaultUserData;
        return entity(UserFactory::class, $data);
    }

    protected function makeEvent($data = null)
    {
        $data = $data? $data: $this->defaultEventData;
        return entity(EventFactory::class, $data);
    }

    protected function makeReg($user, $event, $data = null)
    {
        $data = $data? $data: $this->defaultRegData;
        $data['userId'] = isset($data['userId'])? $data['userId']: $user->id;
        $data['eventId'] = isset($data['eventId'])? $data['eventId']: $event->id;
        return entity(RegistrationFactory::class, $data);
    }

}