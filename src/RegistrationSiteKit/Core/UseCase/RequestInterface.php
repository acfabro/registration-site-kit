<?php


namespace Acfabro\RegistrationSiteKit\Core\UseCase;


interface RequestInterface
{

    public function getData();

    public function getDataItem(string $name);

    public function getParams();

    public function getParam(string $name);

    public function getDependencies();

    public function getDependency(string $name);

}
