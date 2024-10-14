<?php

namespace App\Providers;

use App\Events\UserCreated;
use App\Listeners\SendEmailWithCredentials;
use App\Events\VaccineManager\VaccineRegistrationCompletedEvent;
use App\Listeners\VaccineManager\SendEmailWithVaccineRegistrationData;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        VaccineRegistrationCompletedEvent::class => [
            SendEmailWithVaccineRegistrationData::class,
        ],
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
