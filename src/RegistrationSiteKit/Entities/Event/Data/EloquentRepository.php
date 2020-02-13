<?php


namespace Acfabro\RegistrationSiteKit\Entities\Event\Data;


use Acfabro\RegistrationSiteKit\Core\Data\BaseRepository;
use Acfabro\RegistrationSiteKit\Entities\Event\EventInterface;

/**
 * Class EloquentRepository
 *
 * Eloquent-based repository
 *
 * @package Acfabro\RegistrationSiteKit\Entities\Event\Data
 */
class EloquentRepository extends BaseRepository implements RepositoryInterface
{

    /**
     * Uses an eloquent model as model
     *
     * @param \Acfabro\RegistrationSiteKit\Entities\Event\Data\Eloquent\Event $model
     */
    public function __construct($model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function all()
    {
        // TODO implement
    }

    /**
     * @inheritDoc
     */
    public function find($id)
    {
        // TODO implement
    }

    /**
     * @inheritDoc
     */
    public function create(EventInterface $user)
    {
        // TODO implement
    }

    /**
     * @inheritDoc
     */
    public function update(EventInterface $user)
    {
        // TODO implement
    }

    /**
     * @inheritDoc
     */
    public function delete(EventInterface $user)
    {
        // TODO implement
    }

    /**
     * @inheritDoc
     */
    public function activate(EventInterface $event)
    {
        // TODO implement
    }

    /**
     * @inheritDoc
     */
    public function cancel(EventInterface $event)
    {
        // TODO implement
    }
}