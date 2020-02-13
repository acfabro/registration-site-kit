<?php

namespace Acfabro\RegistrationSiteKitTests\Unit\Event;

use Acfabro\RegistrationSiteKit\Entities\Event\Event;
use Acfabro\RegistrationSiteKit\Entities\Event\EventInterface;
use Acfabro\RegistrationSiteKit\Entities\Event\EventFactory;
use Acfabro\RegistrationSiteKit\Util\Id\UuidIdGenerator;
use Acfabro\RegistrationSiteKitTests\RskTestCase;
use Carbon\Carbon;
use function Acfabro\RegistrationSiteKit\ServiceProviders\entity;

class EventTest extends RskTestCase
{
    protected $data = [];

    public function testCreateByAppContainer()
    {
        $event = entity(EventFactory::class, $this->data);
        $this->assertInstanceOf(EventInterface::class, $event);
    }
    
    public function testId()
    {
        $this->setupData();

        $idGen = new UuidIdGenerator();
        $newId = $idGen->generate();
        $this->data['id'] = $newId;

        $event = entity(EventFactory::class, $this->data);
        $this->assertSame($event->id, $newId);
    }

    public function testDescription()
    {
        $this->setupData();
        $event = entity(EventFactory::class, $this->data);
        $this->assertSame($event->description, $this->data['description']);
    }

    public function testStart()
    {
        $this->setupData();
        $event = entity(EventFactory::class, $this->data);
        $this->assertSame($event->start, $this->data['start']);
    }

    public function testEnd()
    {
        $this->setupData();
        $event = entity(EventFactory::class, $this->data);
        $this->assertSame($event->end, $this->data['end']);
    }

    public function testName()
    {
        $this->setupData();
        $event = entity(EventFactory::class, $this->data);
        $this->assertSame($event->name, $this->data['name']);
    }

    public function testStatus()
    {
        $this->setupData();
        $event = entity(EventFactory::class, $this->data);
        $this->assertSame($event->status, $this->data['status']);
    }

    protected function  setupData()
    {
        $this->data = [
            'name' => 'Nine-Nine!!',
            'description' => 'The biggest event for Nine-Nine fans',
            'start' => Carbon::create(2020, 3,1,8,0,0)->toDateTime(),
            'end' => Carbon::create(2020, 3,3,17,0,0)->toDateTime(),
            'status' => Event::STATUS_ACTIVE,
        ];
    }

}
