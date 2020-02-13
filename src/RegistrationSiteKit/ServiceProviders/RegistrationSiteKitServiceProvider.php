<?php

namespace Acfabro\RegistrationSiteKit\ServiceProviders;

use Acfabro\RegistrationSiteKit\Core\Entity\EntityInterface;
use Acfabro\RegistrationSiteKit\Util\Id\IdGeneratorInterface;
use Acfabro\RegistrationSiteKit\Util\Id\UuidIdGenerator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class RegistrationSiteKitServiceProvider extends ServiceProvider
{
    public function register()
    {
        // config
        $this->mergeConfigFrom(__DIR__.'/../../../config/rsk-config.php', 'rsk-config');

        // id generator
        $this->app->bind(IdGeneratorInterface::class, function () {
            return new UuidIdGenerator();
        });

//        // event provider
//        $this->app->bind(EventInterface::class, function ($app, $data) {
//            $config = $app['config']->get('rsk-config.entities.event');
//            $class = $config['class'];
//
//            return $class::factory($data,
//                ['idGenerator' => app()->make(IdGeneratorInterface::class)],
//                $config);
//        });
//
//        // user provider
//        $this->app->bind(UserInterface::class, function ($app, $data) {
//            $config = config('rsk-config.entities.user');
//            $class = $config['class'];
//
//            return $class::factory($data, ['idGenerator' => $app['idGenerator']], $config);
//        });
//
//        // registration entity provider
//        $this->app->bind(RegistrationInterface::class, function ($app, $data) {
//            $config = config('rsk-config.entities.registration');
//            $class = $config['class'];
//
//            return $class::factory($data, ['idGenerator' => $app['idGenerator']], $config);
//        });

    }

    public function boot()
    {
        if (function_exists('config_path')) {
            // publish configs
            $this->publishes([
                __DIR__ . '/../../../config/rsk-config.php' => config_path('rsk-config.php'),
            ], 'configs');
        }

        // load this ppackage's routes
        $this->loadRoutesFrom(__DIR__.'/../../../routes/rsk-routes.php');

    }

}

// helper functions
if (!function_exists('entity')) {

    /**
     * Helper function to make entities via factories. Factories are still useful for automatic injection
     * Shortcur for:
     * ```
     * $factory = app(EntityFactory::class);
     * $entity = $factory->make($data);
     * ```
     *
     * @param string $factoryClass the factory that will be used to make the entity
     * @param array $data input data
     * @return EntityInterface
     * @throws BindingResolutionException
     */
    function entity($factoryClass, $data)
    {
        $factory = app($factoryClass);
        return $factory->make($data);
    }
}