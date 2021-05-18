<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Models;

use Illuminate\Database\Eloquent\Builder;
use Tipoff\Locations\Models\Location;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;

/**
 * @property string name
 * @property string title
 * @property string slug
 * @property float percent
 * @property string tax_code
 *
 */
class Tax extends BaseModel
{
    use HasCreator;
    use HasPackageFactory;

    protected $casts = [
        'percent' => 'float',
    ];

    public static function findTaxByLocationAndCode(int $locationId, ?string $taxCode = null): ?Tax
    {
        /** @var ?Tax $tax */
        $tax = static::query()
            ->where('location_id', '=', $locationId)
            ->where(function (Builder $query) use ($taxCode) {
                if (is_null($taxCode)) {
                    $query->whereNull('tax_code');
                } else {
                    $query->where('tax_code', '=', $taxCode);
                }
            })
            ->first();

        return $tax;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*public function bookings()
    {
        return $this->hasMany(app('booking'));
    }*/

    public function location()
    {
        return $this->belongsTo(app('location'));
    }
}
