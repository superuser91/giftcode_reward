<?php

namespace Vgplay\Giftcode;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Vgplay\Giftcode\Models\Giftcode;

class GiftcodeServiceProvider extends ServiceProvider
{
    /**
     * Get the policies defined on the provider.
     *
     * @return array
     */
    public function policies()
    {
        return [
            Giftcode::class => config('vgplay.giftcodes.policy'),
        ];
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'vgplay');
    }

    public function boot()
    {
        $this->registerPolicies();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'vgplay');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
