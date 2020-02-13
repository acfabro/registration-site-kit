<?php


namespace Acfabro\RegistrationSiteKit\Core\UseCase;


/**
 * Class Request
 * @package Acfabro\RegistrationSiteKit\Core\UseCase
 */
class Request implements RequestInterface
{
    /**
     * Input data, domain-centric
     * @var mixed
     */
    protected array $data;

    /**
     * Parameters used to modify execution settings
     * @var mixed
     */
    protected $params;

    /**
     * Other dependencies
     * @var mixed
     */
    protected $dependencies;

    public function __construct($data, $params=[], $dependencies=[])
    {
        $this->data = $data;
        $this->params = $params;
        $this->dependencies = $dependencies;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        $this->params = $params;
    }

    /**
     * @param mixed $dependencies
     */
    public function setDependencies($dependencies): void
    {
        $this->dependencies = $dependencies;
    }


    public function getDataItem(string $name)
    {
        return isset($this->data[$name])? $this->data[$name]: null;
    }

    public function getParam(string $name)
    {
        return isset($this->params[$name])? $this->params[$name]: null;
    }

    public function getDependency(string $name)
    {
        return isset($this->dependencies[$name])? $this->dependencies[$name]: null;
    }
}