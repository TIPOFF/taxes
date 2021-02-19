<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Models;

use Tipoff\Locations\Models\Location;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class LocationTax extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;

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
}
