<?php

namespace AccessManager\Services\Providers;


use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->bootPlans();
        $this->bootPolicies();
        $this->loadMigrationsFrom( __DIR__ . "/../Database/Migrations");
    }

    private function bootPlans()
    {
        $this->loadRoutesFrom(__DIR__ . "/../Plans/Routes/web.php");
        $this->loadViewsFrom(__DIR__ . "/../Plans/Views", "Plan");
    }

    private function bootPolicies()
    {
        $this->loadRoutesFrom(__DIR__ . "/../Policies/Routes/web.php");
        $this->loadViewsFrom(__DIR__ . "/../Policies/Views", "Policy");
    }
}