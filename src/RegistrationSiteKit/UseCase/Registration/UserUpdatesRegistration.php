<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Registration;


use Acfabro\RegistrationSiteKit\Core\Exception\ClassNotFoundException;
use Acfabro\RegistrationSiteKit\Core\Exception\InsufficientParametersException;
use Acfabro\RegistrationSiteKit\Core\UseCase\RequestInterface;
use Acfabro\RegistrationSiteKit\Core\UseCase\Response;
use Acfabro\RegistrationSiteKit\Core\UseCase\ResponseInterface;
use Acfabro\RegistrationSiteKit\Core\UseCase\UseCaseInterface;
use Acfabro\RegistrationSiteKit\Core\Validation\ValidatorFactory;
use Acfabro\RegistrationSiteKit\Entities\Registration\Data\RepositoryInterface as RegistrationRepository;
use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationFactory;
use Acfabro\RegistrationSiteKit\UseCase\Registration\Event\RegistrationUpdated;

/**
 * Class UpdateRegistration
 *
 * Updates a registration's data
 *
 * @package Acfabro\RegistrationSiteKit\UseCase\Registration
 */
class UserUpdatesRegistration implements UseCaseInterface
{
    use CanCheckIfRegistrationExists,
        CanCheckIfUserAlreadyRegistered;

    /**
     * @var RegistrationRepository
     */
    protected $repository;

    protected $registration;
    /**
     * @var ValidatorFactory
     */
    private $validation;
    /**
     * @var RegistrationFactory
     */
    private $factory;

    public function __construct(RegistrationRepository $repository, RegistrationFactory $factory, ValidatorFactory $validation)
    {
        $this->repository = $repository;
        $this->validation = $validation;
        $this->factory = $factory;
    }

    /**
     * @param RequestInterface $input
     * @param ResponseInterface $output
     * @return bool
     * @throws RegistrationNotFoundException
     * @throws UserAlreadyRegisteredException
     * @throws ClassNotFoundException
     * @throws InsufficientParametersException
     */
    public function execute(RequestInterface $input, ResponseInterface $output)
    {
        // find the registration
        if (!$this->checkIfRegistrationExists($this->repository, $input->getDataItem('id'))) {
            throw new RegistrationNotFoundException(
                'Cannot update registration not found: ' . $input->getDataItem('id')
            );
        }

        // check if user already has a registration
        if ($this->checkIfUserAlreadyRegistered($this->repository, $input->getDataItem('userId'))) {
            throw new UserAlreadyRegisteredException(
                'User already registered: ' . $input->getDataItem('userId')
            );
        }

        // turn array to entity
        $registration = $this->factory->make($input->getData());

        // save new registration
        $this->repository->update($registration);

        // notify subscribers registration updated
        event(new RegistrationUpdated($this->registration));

        $output->setStatus(Response::STATUS_SUCCESS)
            ->setMessage('Registration updated: ' . $input->getDataItem('id'))
            ->setDataItem('registration', $registration);

        return true;

    }

}