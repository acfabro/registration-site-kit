<?php

namespace Acfabro\RegistrationSiteKit\Entities\Event;


use Acfabro\RegistrationSiteKit\Core\Entity\EntityInterface;

/**
 * Individual event
 *
 * Interface EventInterface
 * @package Acfabro\RegistrationSiteKit\Entities\Event
 */
interface EventInterface extends EntityInterface
{
    /**
     * Event ID
     *
     * @return mixed
     */
    public function id();

    /**
     * Event name
     *
     * @return string
     */
    public function name();

    /**
     * Event Description
     * @return string
     */
    public function description();

    /**
     * Start date
     * @return \DateTime
     */
    public function start();

    /**
     * End date
     * @return \DateTime
     */
    public function end();

    /**
     * Status
     * @return string
     */
    public function status();

}
