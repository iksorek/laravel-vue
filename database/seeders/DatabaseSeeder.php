<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Bookable;
use App\Models\Booking;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(50)->create();

        Bookable::factory()->count(100)->create();
        Address::factory()->count(100)->create();
        Booking::factory()->count(200)->create();
        Bookable::all()->each(function (Bookable $bookable) {
            $reviews = Review::factory()->count(rand(5, 30))->make();
            $bookable->reviews()->saveMany($reviews);
        });
        User::all()->each(function (User $user) {
            $bookings = Booking::factory()->count(5)->make();
            $user->bookings()->saveMany($bookings);
        }

        );
    }
}
