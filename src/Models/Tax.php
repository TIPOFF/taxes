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

    public function locationTaxes()
    {
        return $this->hasMany(LocationTax::class, 'tax_id');
    }
}
