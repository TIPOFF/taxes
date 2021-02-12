<?php

declare(strict_types=1);

namespace Tipoff\Taxes;

use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;
use Tipoff\Taxes\Models\Tax;
use Tipoff\Taxes\Policies\TaxPolicy;

class TaxesServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Tax::class => TaxPolicy::class,
            ])
            ->name('taxes')
            ->hasConfigFile();
    }
}
