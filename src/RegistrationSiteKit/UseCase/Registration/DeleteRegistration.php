<?php


namespace Acfabro\RegistrationSiteKit\UseCase\Registration;


use Acfabro\RegistrationSiteKit\Core\UseCase\RequestInterface;
use Acfabro\RegistrationSiteKit\Core\UseCase\Response;
use Acfabro\RegistrationSiteKit\Core\UseCase\ResponseInterface;
use Acfabro\RegistrationSiteKit\Core\UseCase\UseCaseInterface;
use Acfabro\RegistrationSiteKit\Core\Validation\ValidatorFactory;
use Acfabro\RegistrationSiteKit\Entities\Registration\Data\RepositoryInterface as RegistrationRepository;
use Acfabro\RegistrationSiteKit\UseCase\Registration\Event\RegistrationDeleted;

/**
 * Class DeleteRegistration
 *
 * Deletes a registration record
 *
 * @package Acfabro\RegistrationSiteKit\UseCase\Registration
 */
class DeleteRegistration implements UseCaseInterface
{

    /**
     * @var RegistrationRepository
     */
    protected $repository;

    /**
     * @var ValidatorFactory
     */
    private $validation;

    public function __construct(RegistrationRepository $repository, ValidatorFactory $validation)
    {
        $this->repository = $repository;
        $this->validation = $validation;
    }

    /**
     * @param RequestInterface $input
     * @param ResponseInterface $output
     * @return bool
     */
    public function execute(RequestInterface $input, ResponseInterface $output)
    {
        $data = $input->getData();

        // validate the id exists
        $validation = $this->validation->make($data, [
            'id' => function($attribute, $value, $fail) use ($data) {
                if (!$this->repository->find($data['id'])) {
                    throw new RegistrationNotFoundException(
                        'Cannot delete registration not found: ' . $data['id']
                    );
                }
            }
        ]);

        // get the object because it is a required parameter to delete
        $registration = $this->repository->find($data['id']);

        // delete it
        $this->repository->delete($registration);

        // send event
        event(new RegistrationDeleted($registration));

        $output->setStatus(Response::STATUS_SUCCESS)
            ->setMessage('Registration deleted: ' . $data['id']);

        //
        return true;
    }




}