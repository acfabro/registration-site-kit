<?php


namespace Acfabro\RegistrationSiteKit\Core\UseCase;


interface UseCaseInterface
{
    public function execute(RequestInterface $input, ResponseInterface $output);
}