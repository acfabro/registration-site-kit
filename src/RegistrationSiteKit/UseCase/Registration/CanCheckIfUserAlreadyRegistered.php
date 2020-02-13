<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Registration;


use Acfabro\RegistrationSiteKit\Entities\Registration\Data\RepositoryInterface;

trait CanCheckIfUserAlreadyRegistered
{
    protected function checkIfUserAlreadyRegistered(RepositoryInterface $repo, $userId)
    {
        // find unique by userId
        return $repo->findByUserId($userId);
    }
}