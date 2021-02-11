<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests;

use Tipoff\Support\SupportServiceProvider;
use Tipoff\Taxes\TaxesServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SupportServiceProvider::class,
            TaxesServiceProvider::class,
        ];
    }
}
