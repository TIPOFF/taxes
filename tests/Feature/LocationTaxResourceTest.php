<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Taxes\Models\LocationTax;
use Tipoff\Taxes\Tests\TestCase;
use Tipoff\TestSupport\Models\User;

class LocationTaxResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        LocationTax::factory()->count(1)->create();

        $this->actingAs(self::createPermissionedUser('view location taxes', true));

        $response = $this->getJson('nova-api/location-taxes')->assertOk();

        $this->assertCount(1, $response->json('resources'));
    }
}
