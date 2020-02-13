<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Registration;


use Acfabro\RegistrationSiteKit\Core\Exception\ClassNotFoundException;
use Acfabro\RegistrationSiteKit\Core\Exception\InputValidationException;
use Acfabro\RegistrationSiteKit\Core\Exception\InsufficientParametersException;
use Acfabro\RegistrationSiteKit\Core\UseCase\RequestInterface;
use Acfabro\RegistrationSiteKit\Core\UseCase\Response;
use Acfabro\RegistrationSiteKit\Core\UseCase\ResponseInterface;
use Acfabro\RegistrationSiteKit\Core\UseCase\UseCaseInterface;
use Acfabro\RegistrationSiteKit\Core\Validation\ValidatorFactory;
use Acfabro\RegistrationSiteKit\Entities\Registration\Data\RepositoryInterface as RegistrationRepository;
use Acfabro\RegistrationSiteKit\Entities\Registration\Registration;
use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationFactory;
use Acfabro\RegistrationSiteKit\UseCase\Registration\Event\RegistrationCreated;
use Illuminate\Validation\Validator;

/**
 * Class CreateUserEventRegistration
 *
 * Registers a user to an event
 *
 * @package Acfabro\RegistrationSiteKit\UseCase\Registration
 */
class UserSubmitsRegistration implements UseCaseInterface
{
    use CanCheckIfUserAlreadyRegistered;

    protected RegistrationFactory $factory;

    protected RegistrationRepository $repository;

    protected ValidatorFactory $validation;

    public function __construct(RegistrationRepository $repository, RegistrationFactory $factory, ValidatorFactory $validation)
    {
        $this->validation = $validation;
        $this->factory = $factory;
        $this->repository = $repository;
    }

    /**
     * @param UserSubmitsRegistrationRequest $input
     * @param UserSubmitsRegistrationResponse $output
     * @return mixed
     * @throws ClassNotFoundException
     * @throws InputValidationException
     * @throws InsufficientParametersException
     * @throws UserAlreadyRegisteredException
     */
    public function execute(RequestInterface $input, ResponseInterface $output)
    {
        /**
         * @var Validator $validation
         * @var Registration $registration
         */

        // merge dependencies into data
        $data = array_merge($input->getData(), [
            'userId' => $input->getUserId(),
            'eventId' => $input->getEventId(),
        ]);

        // perform validation
        $validation = $this->validation->make(
            $data, Registration::validationRules['create'],
        );
        if ($validation->fails()) {
            $output->setCode(Response::STATUS_FAILED)
                ->setErrors($validation->errors());

            throw new InputValidationException('Input validation failed. ' . $validation->errors()->first());
        }

        // check if user already has a registration
        if ($this->checkIfUserAlreadyRegistered($this->repository, $input->getUserId())) {
            throw new UserAlreadyRegisteredException('User has already registered');
        }

        // make the reg entity and save
        $registration = $this->repository->create(
            $this->factory->make($data)
        );

        // set the output's return  values
        $output->setStatus(Response::STATUS_SUCCESS)
            ->setMessage('Registration created: ' . $registration->id)
            ->setRegistration($registration->toArray());

        // notify subscribers new registration made
        // TODO move notifications to Response
        event(new RegistrationCreated($registration));

        //
        return true;
    }

}