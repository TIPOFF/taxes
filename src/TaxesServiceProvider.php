<?php

declare(strict_types=1);

namespace Tipoff\Taxes;

use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;
use Tipoff\Taxes\Models\LocationTax;
use Tipoff\Taxes\Models\Tax;
use Tipoff\Taxes\Policies\LocationTaxPolicy;
use Tipoff\Taxes\Policies\TaxPolicy;

class TaxesServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Tax::class         => TaxPolicy::class,
                LocationTax::class => LocationTaxPolicy::class
            ])
            ->hasNovaResources([
                \Tipoff\Taxes\Nova\LocationTax::class,
                \Tipoff\Taxes\Nova\Tax::class
            ])
            ->name('taxes')
            ->hasConfigFile();
    }
}
