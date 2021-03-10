<?php

declare(strict_types=1);

namespace Tipoff\Taxes;

use Tipoff\Support\Contracts\Taxes\TaxRequest;
use Tipoff\Support\Contracts\Taxes\TaxRequestItem;
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
            ->hasNovaResources([
                \Tipoff\Taxes\Nova\Tax::class,
            ])
            ->hasBindings([
                TaxRequest::class => \Tipoff\Taxes\Services\TaxRequest::class,
                TaxRequestItem::class => \Tipoff\Taxes\Services\TaxRequestItem::class,
            ])
            ->name('taxes')
            ->hasConfigFile();
    }
}
