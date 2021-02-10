<?php namespace Tipoff\Taxes\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Taxes\Models\Tax;

class TaxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tax::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sentence = $this->faker->sentence;

        return [
            'slug'       => Str::slug($sentence),
            'name'       => $sentence,
            'title'      => $sentence,
            'percent'    => $this->faker->numberBetween(1, 50),
            'applies_to' => $this->faker->randomElement(['product', 'booking']),
            'creator_id' => randomOrCreate(app('user')),
        ];
    }
}
