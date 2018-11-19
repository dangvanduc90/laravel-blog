<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Illuminate\Auth\Events\Verified' => [
            'App\Listeners\LogVerifiedUser',
        ],
        'App\Events\OrderShipped' => [
            'App\Listeners\SendShipmentNotification',
        ],
        'item.created' => [
            'App\Events\ItemEvent@itemCreated',
        ],
        'item.updated' => [
            'App\Events\ItemEvent@itemUpdated',
        ],
        'item.deleted' => [
            'App\Events\ItemEvent@itemDeleted',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
