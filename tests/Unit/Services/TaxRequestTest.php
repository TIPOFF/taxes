<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Tests\Unit\Services;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Locations\Models\Location;
use Tipoff\Support\Contracts\Taxes\TaxRequest as TaxRequestInterface;
use Tipoff\Taxes\Enum\TaxCode;
use Tipoff\Taxes\Models\LocationTax;
use Tipoff\Taxes\Models\Tax;
use Tipoff\Taxes\Services\TaxRequest;
use Tipoff\Taxes\Tests\TestCase;

class TaxRequestTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function empty_request()
    {
        /** @var TaxRequestInterface $service */
        $service = $this->app->make(TaxRequestInterface::class);
        $this->assertNotNull($service);

        /** @var TaxRequest $taxRequest */
        $taxRequest = $service::createTaxRequest();
        $this->assertNotNull($taxRequest);

        $taxRequest->calculateTax();
    }

    /** @test */
    public function add_and_get_items()
    {
        /** @var TaxRequestInterface $service */
        $service = $this->app->make(TaxRequestInterface::class);

        /** @var TaxRequest $taxRequest */
        $taxRequest = $service::createTaxRequest();

        $taxRequest->createTaxRequestItem('A', 1, TaxCode::PRODUCT, 1000);
        $taxRequest->createTaxRequestItem('B', 2, TaxCode::BOOKING, 2000);
        $taxRequest->createTaxRequestItem('C', 3, null, 3000);

        $taxItem = $taxRequest->getTaxRequestItem('A');
        $this->assertEquals(1, $taxItem->getLocationId());
        $this->assertEquals(1000, $taxItem->getAmount());
        $this->assertEquals(TaxCode::PRODUCT, $taxItem->getTaxCode());

        $taxItem = $taxRequest->getTaxRequestItem('B');
        $this->assertEquals(2, $taxItem->getLocationId());
        $this->assertEquals(2000, $taxItem->getAmount());
        $this->assertEquals(TaxCode::BOOKING, $taxItem->getTaxCode());

        $taxItem = $taxRequest->getTaxRequestItem('C');
        $this->assertEquals(3, $taxItem->getLocationId());
        $this->assertEquals(3000, $taxItem->getAmount());
        $this->assertNull($taxItem->getTaxCode());

        $taxItem = $taxRequest->getTaxRequestItem('D');
        $this->assertNull($taxItem);
    }

    /** @test */
    public function calculate_tax()
    {
        /** @var LocationTax $locationTax */
        $locationTax = LocationTax::factory()->create([
            'booking_tax_id' => Tax::factory()->create([
                'percent' => 5.00
            ]),
            'product_tax_id' => Tax::factory()->create([
                'percent' => 10.00
            ]),
        ]);

        /** @var TaxRequestInterface $service */
        $service = $this->app->make(TaxRequestInterface::class);

        /** @var TaxRequest $taxRequest */
        $taxRequest = $service::createTaxRequest();

        $taxRequest->createTaxRequestItem('A', $locationTax->location_id, TaxCode::PRODUCT, 1000);
        $taxRequest->createTaxRequestItem('B', $locationTax->location_id, TaxCode::BOOKING, 2000);
        $taxRequest->createTaxRequestItem('C', $locationTax->location_id, null, 3000);

        $taxRequest->calculateTax();

        $taxItem = $taxRequest->getTaxRequestItem('A');
        $this->assertEquals(100, $taxItem->getTax());

        $taxItem = $taxRequest->getTaxRequestItem('B');
        $this->assertEquals(100, $taxItem->getTax());

        $taxItem = $taxRequest->getTaxRequestItem('C');
        $this->assertEquals(0, $taxItem->getTax());
    }
}
