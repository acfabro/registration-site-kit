<?php

namespace Acfabro\RegistrationSiteKit\Entities\Registration;


use Acfabro\RegistrationSiteKit\Core\Entity\Entity;
use Acfabro\RegistrationSiteKit\Core\Entity\EntityInterface;
use Acfabro\RegistrationSiteKit\Entities\Event\Event;
use Acfabro\RegistrationSiteKit\Entities\Event\EventInterface;
use Acfabro\RegistrationSiteKit\Entities\User\User;
use Acfabro\RegistrationSiteKit\Util\Id\IdGeneratorInterface as IdGenerator;
use Acfabro\RegistrationSiteKit\Util\Id\UuidIdGenerator;

/**
 * Class Registration
 *
 * registration record entity
 *
 * @package Acfabro\RegistrationSiteKit\Entities\Registration
 * @property string $id
 * @property string firstName
 * @property string lastName
 * @property string email
 * @property string eventId
 * @property string userId
 */
class Registration extends Entity implements RegistrationInterface
{
    /**
     * @var array Default fillable items; can be overridden by config registration.fillable
     */
    protected $fillable = [
        'id',
        'firstName',
        'lastName',
        'badgeName',
        'email',
        'userId',
        'eventId',
    ];

    /**
     * Validation rules
     * @var array Default validation rules; can be overridden by config registration.validationRules
     */
    const validationRules = [
        'create' => [
            'firstName' => 'required',
            'email' => 'required|email',
            'userId' => 'required',
            'eventId' => 'required',
        ],
        'update' => [
            'id' => 'required',
            'firstName' => 'required',
            'email' => 'required|email',
            'userId' => 'required',
            'eventId' => 'required',
        ],
    ];

    /**
     * @inheritDoc
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function name()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @inheritDoc
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function userId()
    {
        return $this->userId;
    }

    /**
     * @inheritDoc
     */
    public function eventId()
    {
        return $this->eventId;
    }

}
