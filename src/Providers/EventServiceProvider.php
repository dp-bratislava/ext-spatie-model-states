<?php

namespace Dpb\Extension\ModelState\Providers;

use Dpb\Extension\ModelState\Listeners\LogStateChangeListener;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use  Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;
use Spatie\ModelStates\Events\StateChanged;

class EventServiceProvider extends BaseEventServiceProvider
{
    protected $listen = [
        StateChanged::class => [
            LogStateChangeListener::class,
        ],
    ];    
}
