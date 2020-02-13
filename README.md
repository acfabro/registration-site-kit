# registration-site-kit

A Laravel package used to implement an event registration website.

```php
class RegistrationController extends Controller
{

    /**
     * @param RequestAlias $request
     * @param UserSubmitsRegistration $useCase Container-injected use-case
     * @Post("/submit")
     */
    public function submitRegistration(RequestAlias $request, UserSubmitsRegistration $useCase)
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
