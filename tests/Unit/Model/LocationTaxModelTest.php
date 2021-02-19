<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Taxes\Models\LocationTax;
use Tipoff\Taxes\Tests\TestCase;

class LocationTaxModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = LocationTax::factory()->create();
        $this->assertNotNull($model);
    }
}
