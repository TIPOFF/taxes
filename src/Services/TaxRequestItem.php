<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Services;

use Tipoff\Support\Contracts\Taxes\TaxRequestItem as TaxRequestItemInterface;

class TaxRequestItem implements TaxRequestItemInterface
{
    private string $itemId;
    private int $locationId;
    private ?string $taxCode;
    private int $amount;
    private ?string $taxDescription;
    private int $tax;

    public static function createTaxRequestItem(string $itemId, int $locationId, ?string $taxCode, int $amount): TaxRequestItemInterface
    {
        return new static($itemId, $locationId, $taxCode, $amount);
    }

    private function __construct(string $itemId, int $locationId, ?string $taxCode, int $amount)
    {
        $this->itemId = $itemId;
        $this->locationId = $locationId;
        $this->taxCode = $taxCode;
        $this->amount = $amount;
        $this->taxDescription = null;
        $this->tax = 0;
    }

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function getLocationId(): int
    {
        return $this->locationId;
    }

    public function getTaxCode(): ?string
    {
        return $this->taxCode;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setTaxDescription(?string $taxDescription): self
    {
        $this->taxDescription = $taxDescription;

        return $this;
    }

    public function getTaxDescription(): ?string
    {
        return $this->taxDescription;
    }

    public function setTax(int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function getTax(): int
    {
        return $this->tax;
    }
}
