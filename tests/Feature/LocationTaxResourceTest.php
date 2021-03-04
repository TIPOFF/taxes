<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests\Feature\Nova;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Authorization\Models\User;
use Tipoff\Taxes\Models\LocationTax;
use Tipoff\Taxes\Tests\TestCase;

class LocationTaxResourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function index()
    {
        LocationTax::factory()->count(1)->create();

        $this->actingAs(User::factory()->create());

        $response = $this->getJson('nova-api/location-taxes')->assertOk();

        $this->assertCount(1, $response->json('resources'));
    }
}
