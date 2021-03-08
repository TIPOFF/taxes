<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Models;

use Illuminate\Database\Eloquent\Builder;
use Tipoff\Locations\Models\Location;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

/**
 * @property Location location
 * @property string tax_cde
 * @property Tax tax
 * // Raw relation ids
 * @property int location_id
 * @property int tax_id
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
        $locationTax = static::query()
            ->where('location_id', '=', $locationId)
            ->where(function (Builder $query) use ($taxCode) {
                if (is_null($taxCode)) {
                    $query->whereNull('tax_code');
                } else {
                    $query->where('tax_code', '=', $taxCode);
                }
            })
            ->first();

        return $locationTax ? $locationTax->tax : null;
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
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    //endregion
}
