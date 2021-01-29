<?php

namespace Tipoff\Taxes;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\Taxes\Commands\TaxesCommand;

class TaxesServiceProvider extends PackageServiceProvider
{
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
            ->hasViews()
            ->hasMigration('create_taxes_table')
            ->hasCommand(TaxesCommand::class);
    }
}
