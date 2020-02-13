<?php


namespace Acfabro\RegistrationSiteKit\Entities\User\Data;


use Acfabro\RegistrationSiteKit\Core\Data\BaseRepository;
use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationInterface;
use Acfabro\RegistrationSiteKit\Entities\User\User;
use Acfabro\RegistrationSiteKit\Entities\User\UserInterface;
use Illuminate\Support\Collection;

/**
 * Class CollectionRepository
 * Used for tests
 * @package Acfabro\RegistrationSiteKit\Entities\User\Data
 */
class CollectionRepository extends BaseRepository implements RepositoryInterface
{
    /**
     * ArrayRepository constructor.
     *
     * use a collection by default
     *
     * @param Collection $model
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
    public function findByUsername($username)
    {
        return $this->model->filter(function($value) use ($username) {
            return $value->username == $username;
        })->first();
    }

    /**
     * @inheritDoc
     */
    public function create(UserInterface $user)
    {
        $this->model->put($user->id(), $user);
    }

    /**
     * @inheritDoc
     */
    public function update(UserInterface $user)
    {
        $id = $user->id();

        $userToUpdate = $this->model->filter(function (UserInterface $item) use ($id) {
            return $item->id() == $id;
        })->first();

        $userToUpdate->fill($user->toArray());
    }

    /**
     * @inheritDoc
     */
    public function delete($user)
    {
        $this->model->forget($user->id());
    }


    public function activate($user)
    {
        $user->status = User::STATUS_ACTIVE;
        $this->update($user);
    }

    public function deactivate($user)
    {
        $user->status = User::STATUS_INACTIVE;
        $this->update($user);
    }
}