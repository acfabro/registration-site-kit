<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Event;


use Acfabro\RegistrationSiteKit\Core\UseCase\UseCaseInterface;
use Acfabro\RegistrationSiteKit\Entities\Event\Data\RepositoryInterface as EventRepository;
use Acfabro\RegistrationSiteKit\Entities\Event\EventFactory;
use Acfabro\RegistrationSiteKit\Entities\Event\EventInterface as Event;

/**
 * Class UpdateEvent
 *
 * Use case: update an event's details
 *
 * @package Acfabro\RegistrationSiteKit\UseCase\Event
 */
class UpdateEvent implements UseCaseInterface
{

    /**
     * @var EventRepository
     */
    protected EventRepository $eventRepo;

    /**
     * @var array|object
     */
    protected $eventData;

    /**
     * @var EventFactory
     */
    protected EventFactory $factory;

    public function __construct(EventRepository $repository, EventFactory $factory, $event)
    {
        $this->eventRepo = $repository;
        $this->eventData = $event;
        $this->factory = $factory;
    }
    public function execute()
    {
        // create an event object
        $event = $this->factory->make($this->eventData);

        // save
        return $this->eventRepo->create($event);
    }
}