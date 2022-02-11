<?php

namespace Vgplay\Giftcode;

use Illuminate\Support\ServiceProvider;

class GiftcodeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'giftcode-reward');
        $this->mergeConfigFrom(__DIR__ . '/../config/giftcode_reward.php', 'giftcode_reward');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
