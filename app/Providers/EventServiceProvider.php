<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\GenerateShop;
use App\Listeners\GenerateCategory;
use App\Events\GenerateRelationProductTokped;
use App\Events\GenerateCategoryEvent;

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
        GenerateRelationProductTokped::class =>[
            \App\Listeners\GenerateShop::class,            
            // \App\Listeners\GenerateCategory::class,
        ],
        GenerateCategoryEvent::class =>[            
            \App\Listeners\GenerateCategory::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
