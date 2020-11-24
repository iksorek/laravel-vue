<?php

namespace Database\Factories;

use App\Models\Bookable;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $from = Carbon::instance($this->faker->dateTimeBetween('-1 months', '+1 months'));
        $to = (clone $from)->addDays(random_int(1, 14));
        return [
            'from' => $from,
            'to' => $to,
            'bookable_id'=> Bookable::all()->random()->id,

        ];
    }
}
