<?php


namespace Acfabro\RegistrationSiteKit\Util\Id;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class UuidIdGenerator implements IdGeneratorInterface
{
    /**
     * @inheritDoc
     */
    public function generate(): string
    {
        // Generate a version 1 (time-based) UUID object
        $uuid1 = Uuid::uuid4();
        return $uuid1->toString();
    }
}