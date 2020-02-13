<?php

namespace Acfabro\RegistrationSiteKit\Core\Entity;


use Acfabro\RegistrationSiteKit\Core\Exception\ClassNotFoundException;

/**
 * Class EntityFactory
 *
 * Abstract entity factory. This is mainly used for automatic injections by the app container
 *
 * @package Acfabro\RegistrationSiteKit\Core\Entity
 */
abstract class AbstractEntityFactory
{
    /**
     * Create a valid-state entity using data (for attributes) and params (for dependencies, etc)
     *
     * @param array $data
     * @param array $params
     * @param array $config
     * @return EntityInterface
     * @throws ClassNotFoundException
     */
    public function make(array $data, array $params = [], array $config = [])
    {
        // instantiate the config'ed instance
        $class = $config['class'];
        if (!class_exists($class)) {
            throw new ClassNotFoundException("Cannot build entity. Class '{$class}' does not exist");
        }

        return new $class($data, $config);

    }
}
