<?php

namespace Elbgoods\SwissCantonRule;

use Illuminate\Support\ServiceProvider;
use Wnx\SwissCantons\CantonManager;

class SwissCantonRuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CantonManager::class);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/swissCantonRule'),
        ], 'lang');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'swissCantonRule');
    }
}
