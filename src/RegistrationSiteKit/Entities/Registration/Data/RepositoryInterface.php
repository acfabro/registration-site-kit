<?php


namespace Acfabro\RegistrationSiteKit\Entities\Registration\Data;


use Acfabro\RegistrationSiteKit\Core\Data\BaseRepositoryInterface;
use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationInterface;
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
     * @return RegistrationInterface|null
     */
    public function find($id);

    /**
     * Return a registration record by email
     *
     * @param $email
     * @return RegistrationInterface|null
     */
    public function findByEmail($email);

    /**
     * Find a reg by userId
     * @param $userId
     * @return RegistrationInterface|null
     */
    public function findByUserId($userId);

    /**
     * Create a new registration record
     *
     * @param RegistrationInterface $registration
     */
    public function create(RegistrationInterface $registration);

    /**
     * Update a registration record
     *
     * @param $registration
     * @return mixed
     */
    public function update(RegistrationInterface $registration);

    /**
     * Delete a registration record
     *
     * @param $registration
     * @return mixed
     */
    public function delete(RegistrationInterface $registration);

}