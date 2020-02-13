<?php

namespace Acfabro\RegistrationSiteKit\UseCase\Registration\Event;


use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationInterface;
use Illuminate\Queue\SerializesModels;

class RegistrationCreated
{
    use SerializesModels;

    public $registration;

    /**
     * Create a new event instance.
     *
     * @param RegistrationInterface $registration
     */
    public function __construct(RegistrationInterface $registration)
    {
        $this->registration = $registration;
    }
}