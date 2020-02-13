<?php


namespace Acfabro\RegistrationSiteKit\Entities\Registration\Data;


use Acfabro\RegistrationSiteKit\Core\Data\BaseRepository;
use Acfabro\RegistrationSiteKit\Entities\Registration\Data\Eloquent\Registration;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RegistrationRepositoryEloquent
 *
 * Eloquent implementation of the registration repository
 *
 * @package Acfabro\RegistrationSiteKit\Entities\Registration
 * @property Model $model
 */
class EloquentRepository extends BaseRepository implements RepositoryInterface
{

    /**
     * @var Registration
     */
    protected $model;

    public function __construct($model)
    {
        parent::__construct(new Registration());
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
        return $this->model->newQuery()
            ->find($id);
    }

    /**
     * @inheritDoc
     */
    public function findByEmail($email)
    {
        return $this->model->newQuery()
            ->where('email', $email)->get();
    }

    /**
     * @inheritDoc
     */
    public function create($registration)
    {
        $this->model->fill($registration->toArray());
        return $this->model->save();
    }

    /**
     * @inheritDoc
     */
    public function update($registration)
    {
        $this->model->fill($registration);
        return $this->model->save();
    }

    /**
     * @inheritDoc
     */
    public function delete($registration)
    {
        return $this->model->newQuery()
            ->where('id', $registration['id'])
            ->delete();
    }

    /**
     * @inheritDoc
     */
    public function findByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->first();
    }
}