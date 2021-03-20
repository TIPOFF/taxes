<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Locations\Models\Location;
use Tipoff\Taxes\Enum\TaxCode;
use Tipoff\Taxes\Models\Tax;

class TaxFactory extends Factory
{
    protected $model = Tax::class;

    public function definition()
    {
        $sentence = $this->faker->sentence;

        return [
            'slug'          => Str::slug($sentence),
            'name'          => $sentence,
            'title'         => $sentence,
            'percent'       => $this->faker->numberBetween(1, 50),
            'tax_code'      => $this->faker->randomElement(TaxCode::getValues()),
            'location_id'   => Location::factory()->create(),
            'creator_id'    => randomOrCreate(app('user')),
        ];
    }
}
