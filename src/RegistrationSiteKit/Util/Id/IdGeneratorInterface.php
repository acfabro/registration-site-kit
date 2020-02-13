<?php


namespace Acfabro\RegistrationSiteKit\Util\Id;


/**
 * Interface IdGeneratorInterface
 *
 * Interface for ID number generators
 *
 * @package Acfabro\RegistrationSiteKit\Util\Id
 */
interface IdGeneratorInterface
{
    /**
     * Generate a new id number
     * @return string
     */
    public function generate(): string;
}