<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests;

use Laravel\Nova\NovaCoreServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Tipoff\Addresses\AddressesServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\Locations\LocationsServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\Taxes\TaxesServiceProvider;
use Tipoff\TestSupport\BaseTestCase;
use Tipoff\TestSupport\Providers\NovaPackageServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SupportServiceProvider::class,
            AddressesServiceProvider::class,
            AuthorizationServiceProvider::class,
            PermissionServiceProvider::class,
            AddressesServiceProvider::class,
            TaxesServiceProvider::class,
            LocationsServiceProvider::class,
            NovaCoreServiceProvider::class,
            NovaPackageServiceProvider::class,
        ];
    }
}
