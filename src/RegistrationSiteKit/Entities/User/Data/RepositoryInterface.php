<?php


namespace Acfabro\RegistrationSiteKit\Entities\User\Data;


use Acfabro\RegistrationSiteKit\Core\Data\BaseRepositoryInterface;
use Acfabro\RegistrationSiteKit\Entities\User\User;
use Acfabro\RegistrationSiteKit\Entities\User\UserInterface;
use Illuminate\Support\Collection;

interface RepositoryInterface extends BaseRepositoryInterface
{

    /**
     * Return all registration records
     *
     * @return Collection
     */
    public function all();

    /**
     * Return a registration record by id
     *
     * @param $id
     * @return UserInterface|null
     */
    public function find($id);

    /**
     * Return a registration record by email
     *
     * @param $email
     * @return UserInterface|null
     */
    public function findByEmail($email);

    /**
     * Find a reg by userId
     * @param $username
     * @return UserInterface|null
     */
    public function findByUsername($username);

    /**
     * Create a new registration record
     *
     * @param UserInterface $user
     */
    public function create(UserInterface $user);

    /**
     * Update a user record
     *
     * @param $user
     * @return mixed
     */
    public function update(UserInterface $user);

    /**
     * Delete a user record
     *
     * @param $user
     * @return mixed
     */
    public function delete(UserInterface $user);

    /**
     * Activate a user
     *
     * @param UserInterface $user
     * @return mixed
     */
    public function activate(UserInterface $user);

    /**
     * Deactivate a user
     * @param UserInterface $user
     * @return mixed
     */
    public function deactivate(UserInterface $user);

}