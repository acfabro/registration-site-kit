<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Registration;


use Acfabro\RegistrationSiteKit\Core\UseCase\Request;
use Acfabro\RegistrationSiteKit\Core\UseCase\RequestInterface;

class UserSubmitsRegistrationRequest extends Request implements RequestInterface
{
    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @var array all the reg data
     */
    protected $data;

    /**
     * @var mixed
     */
    protected $eventId;

    /**
     * @var mixed
     */
    protected $userId;

    public function __construct($data, $eventId, $userId)
    {
        $this->data = $data;
        $this->eventId = $eventId;
        $this->userId = $userId;
    }

}