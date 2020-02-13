<?php


namespace Acfabro\RegistrationSiteKit\Entities\Event\Data;


use Acfabro\RegistrationSiteKit\Core\Data\BaseRepository;
use Acfabro\RegistrationSiteKit\Entities\Event\Event;
use Acfabro\RegistrationSiteKit\Entities\Event\EventInterface;
use Illuminate\Support\Collection;

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
    public function create(EventInterface $user)
    {
        $this->model->put($user->id(), $user);
    }

    /**
     * @inheritDoc
     */
    public function update(EventInterface $user)
    {
        $id = $user->id();

        $userToUpdate = $this->model->filter(function (EventInterface $item) use ($id) {
            return $item->id() == $id;
        })->first();

        $userToUpdate->fill($user->toArray());
    }

    /**
     * @inheritDoc
     */
    public function delete(EventInterface $user)
    {
        $this->model->forget($user->id());
    }

    /**
     * @inheritDoc
     */
    public function activate(EventInterface $event)
    {
        $event->status = Event::STATUS_ACTIVE;
        $this->update($event);
    }

    /**
     * @inheritDoc
     */
    public function cancel(EventInterface $event)
    {
        $event->status = Event::STATUS_CANCELLED;
        $this->update($event);
    }
}