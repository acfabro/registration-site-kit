<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Registration;


use Acfabro\RegistrationSiteKit\Entities\Registration\Data\RepositoryInterface;

trait CanCheckIfRegistrationExists
{
    protected function checkIfRegistrationExists(RepositoryInterface $repo, $registrationId)
    {
        return $repo->find($registrationId);
    }
}