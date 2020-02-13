<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Event;


use Acfabro\RegistrationSiteKit\Core\UseCase\RequestInterface;
use Acfabro\RegistrationSiteKit\Core\UseCase\Response;
use Acfabro\RegistrationSiteKit\Core\UseCase\ResponseInterface;
use Acfabro\RegistrationSiteKit\Core\UseCase\UseCaseInterface;
use Acfabro\RegistrationSiteKit\Core\Validation\ValidatorFactory;
use Acfabro\RegistrationSiteKit\Entities\Event\Data\RepositoryInterface;
use Acfabro\RegistrationSiteKit\Entities\Event\EventFactory;

class CreateEventAnnouncement implements UseCaseInterface
{
    /**
     * @var RepositoryInterface
     */
    private RepositoryInterface $repo;
    /**
     * @var EventFactory
     */
    private EventFactory $factory;
    /**
     * @var ValidatorFactory
     */
    private ValidatorFactory $validation;

    public function __construct(RepositoryInterface $repo, EventFactory $factory, ValidatorFactory $validation)
    {
        $this->repo = $repo;
        $this->factory = $factory;
        $this->validation = $validation;
    }

    public function execute(RequestInterface $input, ResponseInterface $output)
    {
        // TODO: Implement execute() method.

        // validate announcement input data

        // save the announcement to disk

        $output->setStatus(Response::STATUS_SUCCESS);
    }
}