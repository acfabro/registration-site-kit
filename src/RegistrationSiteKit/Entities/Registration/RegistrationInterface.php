<?php


namespace Acfabro\RegistrationSiteKit\Entities\Registration;


use Acfabro\RegistrationSiteKit\Core\Entity\EntityInterface;

interface RegistrationInterface extends EntityInterface
{
    /**
     * Registration Id
     * @return mixed
     */
    public function id();

    /**
     * Registrant's name
     * @return mixed
     */
    public function name();

    /**
     * Registrant's email
     * @return mixed
     */
    public function email();

    /**
     * Registrant's User entity
     * @return mixed
     */
    public function userId();

    /**
     * Event Id for this registration
     * @return mixed
     */
    public function eventId();

}