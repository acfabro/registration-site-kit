<?php

namespace Acfabro\RegistrationSiteKit\Entities\Event;


use Acfabro\RegistrationSiteKit\Core\Entity\Entity;
use DateTime;

/**
 * Class Event
 *
 * Eloquent implementation for the event entity
 *
 * @package Acfabro\RegistrationSiteKit\Entities\Event
 * @property string $id Event ID
 * @property string $name Name of the event
 * @property string $description Description of the event
 * @property string $email Secretariat email
 * @property string $status Event status
 * @property DateTime $start Start datetime
 * @property DateTime $end end datetime
 */
class Event extends Entity implements EventInterface
{
    /**
     * Event is active
     */
    const STATUS_ACTIVE = 'active';

    /**
     * Event is in draft
     */
    const STATUS_DRAFT = 'draft';

    /**
     * Event has been cancelled
     */
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'id', 'name', 'description', 'email', 'start', 'end', 'status',
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
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function start()
    {
        return $this->start;
    }

    /**
     * @inheritDoc
     */
    public function end()
    {
        return $this->end;
    }

    /**
     * @inheritDoc
     */
    public function status()
    {
        return $this->status;
    }

}
