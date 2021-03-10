<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Services;

use Illuminate\Support\Collection;
use Tipoff\Support\Contracts\Taxes\TaxRequest as TaxRequestInterface;
use Tipoff\Taxes\Models\Tax;

class TaxRequest implements TaxRequestInterface
{
    private Collection $taxItems;

    public static function createTaxRequest(): TaxRequestInterface
    {
        return new static;
    }

    public function __construct()
    {
        $this->taxItems = new Collection();
    }

    public function createTaxRequestItem(string $itemId, int $locationId, ?string $taxCode, int $amount): self
    {
        /** @var TaxRequestItem $item */
        $item = TaxRequestItem::createTaxRequestItem($itemId, $locationId, $taxCode, $amount);

        return $this->addTaxRequestItem($item);
    }

    private function addTaxRequestItem(TaxRequestItem $taxRequestItem): self
    {
        $this->taxItems->put($taxRequestItem->getItemId(), $taxRequestItem);

        return $this;
    }

    public function calculateTax(): self
    {
        // Simple for now, only dealing w/item level taxes - not cart level
        $this->taxItems->each(function (TaxRequestItem $item) {
            // Use Location + TaxCode to find Tax Rate
            /** @var Tax $tax */
            if ($tax = Tax::findTaxByLocationAndCode($item->getLocationId(), $item->getTaxCode())) {
                $item->setTaxDescription($tax->title);
                $item->setTax((int) (($item->getAmount() * $tax->percent) / 100));
            }
        });

        return $this;
    }

    public function getTaxRequestItem(string $itemId): ?TaxRequestItem
    {
        return $this->taxItems->get($itemId);
    }
}
