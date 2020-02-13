<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    // prefix is defined in the config file
    'prefix' => config('registration-site-kit.api.prefix', '/api/v1')
], function()  {

    // profile (attendee-ness related)
    Route::group([
        'prefix' => 'profile',
        'middleware' => "auth:" . config('registration-site-kit.auth.guard', 'api'),
    ], function ()  {
        // get profile by email
        Route::get('/me/email/{email}', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\PersonController@fetchByEmail');

        // get myprofile
        Route::get('/me', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\PersonController@me');

        // search name
        Route::get('/find/name/{name}', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\PersonController@findByName');
    });

    // "as a user of the system" related functions
    Route::group([
        'prefix' => 'user',
        'middleware' => "auth:" . config('registration-site-kit.auth.guard', 'api'),
    ], function ()  {
        // change password
        Route::post('/change-password', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\UserController@changePassword');
    });

    Route::group([
        'prefix' => 'agenda',
        'middleware' => "auth:" . config('registration-site-kit.auth.guard', 'api'),
    ], function ()  {
        Route::get('/', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\AgendaController@list');
        Route::get('/speakers', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\AgendaController@speakers');
    });

    Route::group([
        'prefix' => 'event',
        'middleware' => "auth:" . config('registration-site-kit.auth.guard', 'api'),
    ], function ()  {
        Route::get('/', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\EventController@list');
        Route::get('/{id}', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\EventController@view');
    });

    Route::group([
        'prefix' => 'speaker',
        'middleware' => "auth:" . config('registration-site-kit.auth.guard', 'api'),
    ], function ()  {
        Route::get('/', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\PersonController@speakerList');
    });

    Route::group([
        'prefix' => 'shuttle',
        'middleware' => "auth:" . config('registration-site-kit.auth.guard', 'api'),
    ], function ()  {
        Route::get('/', 'Acfabro\\RegistrationSiteKit\\Http\\Controllers\\ShuttleController@list');
    });

    Route::group([
        'prefix' => 'test',
        'middleware' => "auth:" . config('registration-site-kit.auth.guard', 'api'),
    ], function ()  {
        return "This is a test";
    });

});

