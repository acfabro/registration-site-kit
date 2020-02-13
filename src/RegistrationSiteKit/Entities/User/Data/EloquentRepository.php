<?php


namespace Acfabro\RegistrationSiteKit\Entities\User\Data;


use Acfabro\RegistrationSiteKit\Core\Data\BaseRepository;
use Acfabro\RegistrationSiteKit\Entities\User\User;
use Acfabro\RegistrationSiteKit\Entities\User\UserInterface;
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
     * @inheritDoc
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @var Model
     */
    protected $model;

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
    public function create($user)
    {
        $this->model->fill($user->toArray());
        return $this->model->save();
    }

    /**
     * @inheritDoc
     */
    public function update($user)
    {
        $this->model->fill($user);
        return $this->model->save();
    }

    /**
     * @inheritDoc
     */
    public function delete($user)
    {
        return $this->model->newQuery()
            ->where('id', $user['id'])
            ->delete();
    }

    /**
     * @inheritDoc
     */
    public function findByUsername($username)
    {
        return $this->model->newQuery()
            ->where('username', $username)->get();
    }

    public function activate(UserInterface $user)
    {
        return $this->model->newQuery()
            ->where('id', $user->id)
            ->update(['status' => User::STATUS_ACTIVE]);
    }

    public function deactivate(UserInterface $user)
    {
        return $this->model->newQuery()
            ->where('id', $user->id)
            ->update(['status' => User::STATUS_INACTIVE]);
    }
}