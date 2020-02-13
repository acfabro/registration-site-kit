<?php

namespace Acfabro\RegistrationSiteKitTests\Feature\UseCase\Registration;

use Acfabro\RegistrationSiteKit\Core\UseCase\Request;
use Acfabro\RegistrationSiteKit\Core\UseCase\Response;
use Acfabro\RegistrationSiteKit\Core\Validation\ValidatorFactory;
use Acfabro\RegistrationSiteKit\Entities\Registration\Data\CollectionRepository;
use Acfabro\RegistrationSiteKit\Entities\Registration\RegistrationFactory;
use Acfabro\RegistrationSiteKit\UseCase\Registration\UserSubmitsRegistration;
use Acfabro\RegistrationSiteKit\UseCase\Registration\UserSubmitsRegistrationRequest;
use Acfabro\RegistrationSiteKit\UseCase\Registration\UserSubmitsRegistrationResponse;
use Acfabro\RegistrationSiteKit\UseCase\Registration\DeleteRegistration;
use Acfabro\RegistrationSiteKit\UseCase\Registration\UserAlreadyRegisteredException;
use Acfabro\RegistrationSiteKitTests\RskTestCase;
use Acfabro\RegistrationSiteKitTests\Unit\Registration\Setup;
use Illuminate\Support\Collection;

class DeleteRegistrationTest extends RskTestCase
{
    use Setup;

    public function testCanDelete()
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
                $output = new UserSubmitsRegistrationResponse(),
            );

            // get the created reg obj
            $newReg = $output->getRegistration();

            // delete
            $uc = new DeleteRegistration($repo, $validator);
            $uc->execute(
                new Request(['id' => $newReg['id']]),
                $output = new Response(),
            );

            // if we arrive here, we fail
            $this->assertTrue(true);
        } catch (UserAlreadyRegisteredException $e) {
            $this->fail($e->getMessage());
        }

    }

}
