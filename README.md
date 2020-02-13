# registration-site-kit

A Laravel package used to implement an event registration website.

```php
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param UserSubmitsRegistration $useCase Container-injected use-case
     * @Post("/submit")
     * @return array|string
     */
    public function submitRegistration(Request $request, UserSubmitsRegistration $useCase)
    {
        $userId = session('userId');
        $eventId = session('eventId');

        try {
            $useCase->execute(
                new UserSubmitsRegistrationRequest($request->input('data'), $userId, $eventId),
                $output = new UserSubmitsRegistrationResponse()
            );

            return ['registration' => $output->getRegistration()];
        } catch (\Exception $e) {

            return ['messgae' => 'There was an error: ' . $e->getMessage()];
        }
    }
}
```

Extend its capabilities -- use the config files to specify your custom implementations.

```
return [
    'entities' => [
        'event' => [
            // concrete implementation
            'class' => Acfabro\RegistrationSiteKit\Entities\Event\Event::class,
            'id' => 'id',
            'repository' => Acfabro\RegistrationSiteKit\Entities\Event\Data\EloquentRepository::class,
        ],
        'registration' => [
            // custom implementation
            'class' => App\MyCustomPackage\Registration::class,
            'id' => 'id',
            'repository' => App\MyCustomRepos\EloquentRepository::class,
        ],
        'user' => [
            // concrete implementation
            'class' => Acfabro\RegistrationSiteKit\Entities\User\User::class,
            'id' => 'id',
            'repository' => Acfabro\RegistrationSiteKit\Entities\User\Data\EloquentRepository::class,

        ],
        
        // .....
    ],
];
```
