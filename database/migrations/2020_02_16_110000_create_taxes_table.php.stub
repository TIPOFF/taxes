<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Internal reference name
            $table->string('title'); // Shows in book online checkout flow.
            $table->string('slug')->unique()->index();
            $table->unsignedDecimal('percent', 5, 2);
            $table->string('applies_to')->default('order'); // Application. Definitions include: 'order', 'product', 'booking'
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->timestamps();
        });
    }
}
