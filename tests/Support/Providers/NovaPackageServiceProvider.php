<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests\Support\Providers;

use Tipoff\Taxes\Nova\LocationTax;
use Tipoff\Taxes\Nova\Tax;
use Tipoff\TestSupport\Providers\BaseNovaPackageServiceProvider;

class NovaPackageServiceProvider extends BaseNovaPackageServiceProvider
{
    public static array $packageResources = [
        Tax::class,
        LocationTax::class
    ];
}
