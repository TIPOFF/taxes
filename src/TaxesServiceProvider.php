<?php

namespace Tipoff\Taxes;

use Illuminate\Support\Facades\Gate;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\Taxes\Models\Tax;
use Tipoff\Taxes\Policies\TaxPolicy;

class TaxesServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('taxes')
            ->hasConfigFile()
            ->hasViews();
    }

    public function registeringPackage()
    {
        Gate::policy(Tax::class, TaxPolicy::class);
    }
}
