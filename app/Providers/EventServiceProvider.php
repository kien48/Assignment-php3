<?php

namespace App\Providers;

use App\Events\Author\CreateUserAuthor;
use App\Events\Author\LookUpAuthor;
use App\Events\Author\UnLockAuthor;
use App\Listeners\Author\SendNotification;
use App\Listeners\Author\SendNotificationLookUp;
use App\Listeners\Author\SendNotificationUnLock;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateUserAuthor::class => [
            SendNotification::class,
        ],
        LookUpAuthor::class => [
            SendNotificationLookUp::class,
        ],
        UnLockAuthor::class => [
            SendNotificationUnLock::class,
        ],
    ];

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
