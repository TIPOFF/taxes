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
            $table->foreignIdFor(Location::class);
            $table->string('tax_code');

            $table->foreignIdFor(Tax::class);
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();

            $table->unique(['location_id', 'tax_code']);
        });
    }
}
