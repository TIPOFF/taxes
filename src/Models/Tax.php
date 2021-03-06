<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;

/**
 * @property string name
 * @property string title
 * @property string slug
 * @property float percent
 * @property string applies_to
 */
class Tax extends BaseModel
{
    use HasCreator;
    use HasPackageFactory;

    protected $casts = [
        'percent' => 'float',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function bookings()
    {
        return $this->hasMany(app('booking'));
    }

    public function locationBookingTaxes()
    {
        return $this->hasMany(LocationTax::class, 'booking_tax_id');
    }

    public function locationProductTaxes()
    {
        return $this->hasMany(LocationTax::class, 'product_tax_id');
    }
}
