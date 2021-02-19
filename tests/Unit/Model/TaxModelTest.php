<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Taxes\Models\Tax;
use Tipoff\Taxes\Tests\TestCase;

class TaxModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Tax::factory()->create();
        $this->assertNotNull($model);
    }
}
