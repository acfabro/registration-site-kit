<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Registration;


trait CanCheckIfEmailAlreadyRegistered
{
    protected function checkIfEmailAlreadyRegistered($email)
    {
        // find unique by email
        return $this->repository->findByEmail($email);
    }
}