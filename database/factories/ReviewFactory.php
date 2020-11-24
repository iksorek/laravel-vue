<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;


    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'content' => $this->faker->sentence(50),
            'rating' => random_int(1, 5),


        ];

    }
}
