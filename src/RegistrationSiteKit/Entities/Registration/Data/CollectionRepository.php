<?php


namespace Acfabro\RegistrationSiteKit\Entities\Registration\Data;


use Acfabro\RegistrationSiteKit\Core\Data\BaseRepository;
use Acfabro\RegistrationSiteKit\Entities\Registration\Registration;
use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationInterface;
use Illuminate\Support\Collection;
use Acfabro\RegistrationSiteKit\Entities\Registration\Data\RepositoryInterface as RegistrationRepositoryInterface;

/**
 * Class ArrayRepository
 *
 * Collection based persistence repository; used for testing only
 *
 * @package Acfabro\RegistrationSiteKit\Entities\Registration\Data
 * @property Collection $model
 */
class CollectionRepository extends BaseRepository implements RegistrationRepositoryInterface
{

    /**
     * ArrayRepository constructor.
     *
     * use a collection by default
     *
     * @param $model
     */
    public function __construct($model)
    {
        parent::__construct(empty($model)? new Collection(): $model);
    }

    /**
     * @inheritDoc
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @inheritDoc
     */
    public function find($id)
    {
        return $this->model->filter(function($value) use ($id) {
           return $value->id == $id;
        })->first();
    }

    /**
     * @inheritDoc
     */
    public function findByEmail($email)
    {
        return $this->model->filter(function($value) use ($email) {
            return $value->email == $email;
        })->first();
    }

    /**
     * @inheritDoc
     */
    public function findByUserId($userId)
    {
        return $this->model->filter(function($value) use ($userId) {
            return $value->userId == $userId;
        })->first();
    }

    /**
     * @inheritDoc
     */
    public function create(RegistrationInterface $registration)
    {
        $this->model->put($registration->id(), $registration);
        return $registration;
    }

    /**
     * @inheritDoc
     */
    public function update(RegistrationInterface $registration)
    {
        $id = $registration->id();

        $regToUpdate = $this->model->filter(function (RegistrationInterface $item) use ($id) {
            return $item->id() == $id;
        });

        $regToUpdate->fill($registration->toArray());
        return $regToUpdate;
    }

    /**
     * @inheritDoc
     */
    public function delete(RegistrationInterface $registration)
    {
        $this->model->forget($registration->id());

    }
}