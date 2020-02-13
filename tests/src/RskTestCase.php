<?php


namespace Acfabro\RegistrationSiteKitTests;


use Acfabro\RegistrationSiteKit\ServiceProviders\RegistrationSiteKitServiceProvider;
use Orchestra\Testbench\TestCase;

class RskTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            RegistrationSiteKitServiceProvider::class,
        ];
    }
}