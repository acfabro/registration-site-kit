<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Registration;


use Throwable;

class UserAlreadyRegisteredException extends \Exception
{
    public function __construct($message = "User already registered", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}