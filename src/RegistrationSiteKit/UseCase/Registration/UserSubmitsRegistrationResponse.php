<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Registration;


use Acfabro\RegistrationSiteKit\Core\UseCase\Response;
use Acfabro\RegistrationSiteKit\Core\UseCase\ResponseInterface;

class UserSubmitsRegistrationResponse extends Response implements ResponseInterface
{
    protected $registration;

    /**
     * @return array
     */
    public function getRegistration(): array
    {
        return $this->registration;
    }

    /**
     * @param array $registration
     * @return UserSubmitsRegistrationResponse
     */
    public function setRegistration(array $registration): UserSubmitsRegistrationResponse
    {
        $this->registration = $registration;
        $this->setDataItem('registration', $registration);
        return $this;
    }
}