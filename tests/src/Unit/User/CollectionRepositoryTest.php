<?php

namespace Acfabro\RegistrationSiteKitTests\Unit\User;

use Acfabro\RegistrationSiteKit\Entities\User\Data\CollectionRepository;
use Acfabro\RegistrationSiteKit\Entities\User\User;
use Acfabro\RegistrationSiteKit\Entities\User\UserFactory;
use Acfabro\RegistrationSiteKit\Util\Id\UuidIdGenerator;
use Acfabro\RegistrationSiteKitTests\RskTestCase;
use Illuminate\Support\Collection;
use function Acfabro\RegistrationSiteKit\ServiceProviders\entity;

class CollectionRepositoryTest extends RskTestCase
{
    private $sampleData = [
        [
            'id' => '99a825f0-960b-4dda-999c-0ff13c7ffc3a',
            'username' => 'johnsmith',
            'email' => 'john@email.com',
            'status' => User::STATUS_ACTIVE,
        ],
        [
            'id' => '5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac',
            'username' => 'peter123',
            'email' => 'peter@email.com',
            'status' => User::STATUS_ACTIVE,
        ],
        [
            'id' => 'a799f46c-a4f4-4a0b-899f-f3118bdaab97',
            'username' => 'mary456',
            'email' => 'mary@email.com',
            'status' => User::STATUS_UNVERIFIED,
        ],
    ];

    public function testFind()
    {
        $this->setUp();
        $user = $this->repository->find('5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac');
        $this->assertSame($user->username, 'peter123');
    }

    public function testAll()
    {
        $this->setUp();
        $all = $this->repository->all();
        $this->assertSame(count($all), 3);
    }

    public function testUpdate()
    {
        $this->setUp();

        $user = entity(UserFactory::class, [
            'id' => 'a799f46c-a4f4-4a0b-899f-f3118bdaab97',
            'username' => 'mary000',
            'email' => 'mary@email.com',
            'status' => User::STATUS_UNVERIFIED,
        ]);
        $this->repository->update($user);

        $found = $this->repository->find('a799f46c-a4f4-4a0b-899f-f3118bdaab97');
        $this->assertSame($found->username, 'mary000');
    }

    public function testFindByEmail()
    {
        $this->setUp();
        $user = $this->repository->findByEmail('mary@email.com');
        $this->assertSame($user->username, 'mary456');
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

    public function testActivate()
    {
        $this->setUp();
        $item = $this->repository->find('a799f46c-a4f4-4a0b-899f-f3118bdaab97');
        $this->repository->activate($item);

        $item = $this->repository->find('a799f46c-a4f4-4a0b-899f-f3118bdaab97');
        $this->assertSame($item->status, User::STATUS_ACTIVE);
    }

    public function testFindByUsername()
    {
        $this->setUp();
        $user = $this->repository->findByEmail('peter@email.com');
        $this->assertSame($user->id, '5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac');
    }

    public function testCreate()
    {
        $this->setUp();
        $user = entity(UserFactory::class, [
            'id' => 'ed36375f-d601-445b-995c-764eca3429a7',
            'username' => 'jakeperalta',
            'email' => 'jake@email.com',
            'status' => User::STATUS_UNVERIFIED,
        ]);
        $this->repository->create($user);

        $found = $this->repository->find('ed36375f-d601-445b-995c-764eca3429a7');
        $this->assertSame($user, $found);
    }

    protected $repository;
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new CollectionRepository(new Collection());

        foreach ($this->sampleData as $row) {
            $user = entity(UserFactory::class, $row);
            $this->repository->create($user);
        }
    }

}
