<?php

namespace Acfabro\RegistrationSiteKitTests\Unit\Event;

use Acfabro\RegistrationSiteKit\Entities\Event\Data\CollectionRepository;
use Acfabro\RegistrationSiteKit\Entities\Event\Event;
use Acfabro\RegistrationSiteKit\Entities\Event\EventFactory;
use Acfabro\RegistrationSiteKitTests\RskTestCase;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use function Acfabro\RegistrationSiteKit\ServiceProviders\entity;

class CollectionRepositoryTest extends RskTestCase
{

    public function testUpdate()
    {
        $this->setUp();

        $event = entity(EventFactory::class, [
            'id' => '5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac',
            'name' => 'Ten-Ten!!',
            'description' => 'The biggest event for Nine-Nine fans',
            'start' => Carbon::create(2020, 3,1,8,0,0),
            'end' => Carbon::create(2020, 3,3,17,0,0),
            'status' => Event::STATUS_CANCELLED,
        ]);
        $this->repository->update($event);

        $found = $this->repository->find('5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac');
        $this->assertSame($found->status, Event::STATUS_CANCELLED);
    }

    public function testAll()
    {
        $this->setUp();
        $all = $this->repository->all();
        $this->assertSame(count($all), 3);
    }

    public function testCreate()
    {
        $this->setUp();
        $event = entity(EventFactory::class, [
            'id' => 'ed36375f-d601-445b-995c-764eca3429a7',
            'name' => 'One-One!!',
            'description' => 'The biggest event for Nine-Nine fans',
            'start' => Carbon::create(2020, 3,1,8,0,0),
            'end' => Carbon::create(2020, 3,3,17,0,0),
            'status' => Event::STATUS_DRAFT,
        ]);
        $this->repository->create($event);

        $found = $this->repository->find('ed36375f-d601-445b-995c-764eca3429a7');
        $this->assertSame($event, $found);
    }

    public function testDelete()
    {
        $this->setUp();

        $item = $this->repository->find('99a825f0-960b-4dda-999c-0ff13c7ffc3a');
        $this->repository->delete($item);

        $item = $this->repository->find('99a825f0-960b-4dda-999c-0ff13c7ffc3a');
        if (!empty($item)) {
            $this->fail();
        }

        $this->assertTrue(true);
    }

    public function testFind()
    {
        $this->setUp();
        $even = $this->repository->find('5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac');
        $this->assertSame($even->name, 'Ten-Ten!!');
    }

    /**
     * @var CollectionRepository
     */
    protected $repository;
    protected $sampleData = [];
    protected function setUp(): void
    {
        $this->sampleData = [
            [
                'id' => '99a825f0-960b-4dda-999c-0ff13c7ffc3a',
                'name' => 'Nine-Nine!!',
                'description' => 'The biggest event for Nine-Nine fans',
                'start' => Carbon::create(2020, 3,1,8,0,0),
                'end' => Carbon::create(2020, 3,3,17,0,0),
                'status' => Event::STATUS_ACTIVE,
            ],
            [
                'id' => '5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac',
                'name' => 'Ten-Ten!!',
                'description' => 'The biggest event for Nine-Nine fans',
                'start' => Carbon::create(2020, 3,1,8,0,0),
                'end' => Carbon::create(2020, 3,3,17,0,0),
                'status' => Event::STATUS_ACTIVE,
            ],
            [
                'id' => 'a799f46c-a4f4-4a0b-899f-f3118bdaab97',
                'name' => 'Seven-Eleven!!',
                'description' => 'The biggest event for Nine-Nine fans',
                'start' => Carbon::create(2020, 3,1,8,0,0),
                'end' => Carbon::create(2020, 3,3,17,0,0),
                'status' => Event::STATUS_ACTIVE,
            ],
        ];

        parent::setUp();
        $this->repository = new CollectionRepository(new Collection());

        foreach ($this->sampleData as $row) {
            $event = entity(EventFactory::class, $row);
            $this->repository->create($event);
        }
    }
}
