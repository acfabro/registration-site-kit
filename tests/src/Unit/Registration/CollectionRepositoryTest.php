<?php

namespace Acfabro\RegistrationSiteKitTests\Unit\Registration;

use Acfabro\RegistrationSiteKit\Entities\Registration\Data\CollectionRepository;
use Acfabro\RegistrationSiteKitTests\RskTestCase;
use Illuminate\Support\Collection;

class CollectionRepositoryTest extends RskTestCase
{
    use Setup;

    /**
     * @var CollectionRepository
     */
    private $repository;

    private $sampleData = [
        [
            'id' => '99a825f0-960b-4dda-999c-0ff13c7ffc3a',
            'firstName' => 'John',
            'lastName' => 'Smith',
            'email' => 'john@email.com',
            'userId' => '8b376877-31e8-41a8-99bb-51db3d17b0e8',
            'eventId' => '8b376877-31e8-41a8-99bb-51db3d170000',
        ],
        [
            'id' => '5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac',
            'firstName' => 'Peter',
            'lastName' => 'White',
            'email' => 'peter@email.com',
            'userId' => '4c489e33-7a87-42ef-a3d6-b690ee53fbbc',
            'eventId' => '4c489e33-7a87-42ef-a3d6-b690ee530000',
        ],
        [
            'id' => 'a799f46c-a4f4-4a0b-899f-f3118bdaab97',
            'firstName' => 'Mary',
            'lastName' => 'Green',
            'email' => 'mary@email.com',
            'userId' => '307ad767-879a-43e3-afcc-17d39ba87bed',
            'eventId' => '307ad767-879a-43e3-afcc-17d39ba80000',
        ],
    ];

    public function testUpdate()
    {
        $this->setUp();
        $user = $this->makeEvent();
        $event = $this->makeEvent();

        $reg = $this->makeReg($user, $event, [
            'id' => 'ed36375f-d601-445b-995c-764eca3429a7',
            'firstName' => 'Jake',
            'lastName' => 'Peralta',
            'email' => 'jake@email.com',
            'userId' => 'ff556a1e-7a5b-4bbd-8d70-4160ebec2063',
            'eventId' => 'ff556a1e-7a5b-4bbd-8d70-4160ebec0000',
        ]);
        $this->repository->create($reg);

        $found = $this->repository->find('ed36375f-d601-445b-995c-764eca3429a7');
        $this->assertSame($reg, $found);
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

    public function testFindByEmail()
    {
        $this->setUp();

        $reg = $this->repository->findByEmail('peter@email.com');
        $this->assertSame($reg->id(), '5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac');
    }

    public function testFindByUserId()
    {
        $this->setUp();

        $reg = $this->repository->findByUserId('4c489e33-7a87-42ef-a3d6-b690ee53fbbc');
        $this->assertSame($reg->id(), '5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac');
    }

    public function testAll()
    {
        $this->setUp();

        $all = $this->repository->all();
        $this->assertTrue(count($all) == 3);
    }

    public function testCreate()
    {
        $this->setUp();

        $reg = $this->makeReg(null, null, [
            'id' => 'ed36375f-d601-445b-995c-764eca3429a7',
            'firstName' => 'Jake',
            'lastName' => 'Peralta',
            'email' => 'jake@email.com',
            'userId' => 'ff556a1e-7a5b-4bbd-8d70-4160ebec2063',
            'eventId' => 'ff556a1e-7a5b-4bbd-8d70-4160ebec0000',
        ]);
        $this->repository->create($reg);

        $found = $this->repository->find('ed36375f-d601-445b-995c-764eca3429a7');
        $this->assertSame($reg, $found);
    }

    public function testFind()
    {
        $this->setUp();

        $reg = $this->repository->find('5c4eb2cb-769e-4333-9cf9-bc1abc7b9bac');
        $this->assertSame($reg->email(), 'peter@email.com');

    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new CollectionRepository(new Collection());
        $user = $this->makeUser();
        $event = $this->makeEvent();

        foreach ($this->sampleData as $row) {
            $reg = $this->makeReg($user, $event, $row);
            $this->repository->create($reg);

        }
    }

}
