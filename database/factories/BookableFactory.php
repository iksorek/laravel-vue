<?php

namespace Database\Factories;

use App\Models\Bookable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class BookableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bookable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->colorName .' ' . $this->faker->words(2, true),
            'description' => $this->faker->words(150, true),

        ];
    }
}
