<?php

use Acfabro\RegistrationSiteKit\Entities\User\Data\EloquentRepository;

return [

    'entities' => [
        'event' => [
            // concrete implementation
            'class' => Acfabro\RegistrationSiteKit\Entities\Event\Event::class,
            'id' => 'id',
            'repository' => \Acfabro\RegistrationSiteKit\Entities\Event\Data\EloquentRepository::class,
        ],
        'registration' => [
            // concrete implementation
            'class' => Acfabro\RegistrationSiteKit\Entities\Registration\Registration::class,
            'id' => 'id',
            'repository' => \Acfabro\RegistrationSiteKit\Entities\Registration\Data\EloquentRepository::class,
        ],
        'user' => [
            // concrete implementation
            'class' => Acfabro\RegistrationSiteKit\Entities\User\User::class,
            'id' => 'id',
            'repository' => EloquentRepository::class,

        ],
        'agenda' => [
            // concrete implementation
            'class' => Acfabro\RegistrationSiteKit\Entities\Agenda\Agenda::class,
            'id' => 'id',
        ],
        'announcement' => [
            // concrete implementation
            'class' => Acfabro\RegistrationSiteKit\Entities\Announcement\Announcement::class,
            'id' => 'id',
        ],
    ],

];
