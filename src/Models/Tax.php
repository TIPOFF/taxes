<?php namespace Tipoff\Taxes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tipoff\Support\Models\BaseModel;

class Tax extends BaseModel
{
    use HasFactory;

    const APPLIES_TO_PRODUCT = 'product';
    const APPLIES_TO_BOOKING = 'booking';

    protected $guarded = ['id'];

    protected $casts = [
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tax) {
            if (auth()->check()) {
                $tax->creator_id = auth()->id();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function creator()
    {
        return $this->belongsTo(app('user'), 'creator_id');
    }

    public function bookings()
    {
        return $this->hasMany(app('booking'));
    }

    public function locationBookingTaxes()
    {
        return $this->hasMany(app('location'), 'booking_tax_id');
    }

    public function locationProductTaxes()
    {
        return $this->hasMany(app('location'), 'product_tax_id');
    }

    /**
     * Generate taxes by cart item.
     *
     * @param mixed $cartItem
     * @return int
     */
    public function generateTotalTaxesByCartItem($cartItem): int
    {
        $amount = $cartItem->amount;
        $tax = 0;

        if ($cartItem->fee->is_taxed) {
            $amount += $cartItem->total_fees;
        }

        switch ($this->applies_to) {
            case self::APPLIES_TO_PRODUCT:
                break;
            case self::APPLIES_TO_BOOKING:
                $tax = $amount * ($this->percent / 100);

                break;
        }

        return $tax;
    }
}
