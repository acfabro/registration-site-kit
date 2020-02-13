<?php

namespace Acfabro\RegistrationSiteKitTests\Feature\UseCase\Registration;

use Acfabro\RegistrationSiteKit\Core\Validation\ValidatorFactory;
use Acfabro\RegistrationSiteKit\Entities\Registration\Data\CollectionRepository;
use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationFactory;
use Acfabro\RegistrationSiteKit\UseCase\Registration\UserSubmitsRegistration;
use Acfabro\RegistrationSiteKit\UseCase\Registration\UserSubmitsRegistrationRequest;
use Acfabro\RegistrationSiteKit\UseCase\Registration\UserSubmitsRegistrationResponse;
use Acfabro\RegistrationSiteKit\UseCase\Registration\UserAlreadyRegisteredException;
use Acfabro\RegistrationSiteKitTests\RskTestCase;
use Acfabro\RegistrationSiteKitTests\Unit\Registration\Setup;
use Exception;
use Illuminate\Support\Collection;

class CreateEventRegistrationTest extends RskTestCase
{
    use Setup;

    public function testCreateSuccessful()
    {
        try {
            $user = $this->makeUser();
            $event = $this->makeEvent();
            $validator = app(ValidatorFactory::class);
            $factory = app(RegistrationFactory::class);

            $collection = new Collection();
            $repo = new CollectionRepository($collection);
            $uc = new UserSubmitsRegistration($repo, $factory, $validator);

            $uc->execute(
                new UserSubmitsRegistrationRequest($this->defaultRegData, $event->id, $user->id),
                $output = new UserSubmitsRegistrationResponse(),
            );

            $this->assertTrue($collection->where(
                'id', $output->getDataItem('registration')['id']
            )->count() > 0);

        } catch (Exception $e) {
            $this->fail();

        }
    }

    public function testCanCatchUserAlreadyRegisteredException()
    {
        try {
            $repo = new CollectionRepository(new Collection());

            $user = $this->makeUser();
            $event = $this->makeEvent();
            $validator = app(ValidatorFactory::class);
            $factory = app(RegistrationFactory::class);
            $regData = $this->defaultRegData;

            // insert once
            $uc = new UserSubmitsRegistration($repo, $factory, $validator);
            $uc->execute(
                new UserSubmitsRegistrationRequest($regData, $event->id, $user->id),
                new UserSubmitsRegistrationResponse(),
            );

            // insert again
            $uc = new UserSubmitsRegistration($repo, $factory, $validator);
            $uc->execute(
                new UserSubmitsRegistrationRequest($regData, $event->id, $user->id),
                new UserSubmitsRegistrationResponse(),
            );

            // if we arrive here, we fail
            $this->fail();
        } catch (UserAlreadyRegisteredException $e) {

            $this->assertTrue(true);
        }
    }

}
