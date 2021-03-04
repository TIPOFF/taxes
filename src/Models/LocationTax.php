<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Models;

use Tipoff\Locations\Models\Location;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;
use Tipoff\Taxes\Enum\TaxCode;

/**
 * @property Location location
 * @property Tax bookingTax
 * @property Tax productTax
 * // Raw relation ids
 * @property int location_id
 * @property int booking_tax_id
 * @property int product_tax_id
 * @property int creator_id
 * @property int updater_id
 */
class LocationTax extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;

    public static function findTaxByLocationAndCode(int $locationId, ?string $taxCode = null): ?Tax
    {
        /** @var LocationTax $locationTax */
        if ($locationTax = static::query()->where('location_id', '=', $locationId)->first()) {
            if ($taxCode === TaxCode::BOOKING) {
                return $locationTax->bookingTax;
            }

            if ($taxCode === TaxCode::PRODUCT) {
                return $locationTax->productTax;
            }

            // TODO - default tax for location?  exception for unexpected tax code?
        }

        return null;
    }

    //region RELATIONS

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingTax()
    {
        return $this->belongsTo(Tax::class, 'booking_tax_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productTax()
    {
        return $this->belongsTo(Tax::class, 'product_tax_id');
    }

    //endregion
}
