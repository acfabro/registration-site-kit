<?php


namespace Acfabro\RegistrationSiteKit\Entities\Event\Data;


use Acfabro\RegistrationSiteKit\Core\Data\BaseRepositoryInterface;
use Acfabro\RegistrationSiteKit\Entities\Event\EventInterface;
use Illuminate\Support\Collection;

interface RepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Return all event records
     *
     * @return Collection
     */
    public function all();

    /**
     * Return a event record by id
     *
     * @param $id
     * @return EventInterface|null
     */
    public function find($id);

    /**
     * Create a new event record
     *
     * @param EventInterface $event
     */
    public function create(EventInterface $event);

    /**
     * Update a event record
     *
     * @param $event
     * @return mixed
     */
    public function update(EventInterface $event);

    /**
     * Delete a event record
     *
     * @param $event
     * @return mixed
     */
    public function delete(EventInterface $event);

    /**
     * Set event to active
     *
     * @param EventInterface $event
     * @return mixed
     */
    public function activate(EventInterface $event);

    /**
     * Set event to cancelled
     *
     * @param EventInterface $event
     * @return mixed
     */
    public function cancel(EventInterface $event);

}