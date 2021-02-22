<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tipoff\Locations\Models\Location;
use Tipoff\Taxes\Models\Tax;

class CreateLocationTaxesTable extends Migration
{
    public function up()
    {
        Schema::create('location_taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Location::class)->unique();	// NOTE - unique() added -- there should be exactly one record per location!
            $table->foreignIdFor(Tax::class, 'booking_tax_id')->nullable(); // Location's tax rate for bookings.
            $table->foreignIdFor(Tax::class, 'product_tax_id')->nullable(); // Different tax rate for products.
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
