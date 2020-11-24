<?php

namespace Database\Seeders;

use App\Models\Bookable;
use App\Models\Booking;
use App\Models\Review;
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
        // \App\Models\User::factory(10)->create();
        Bookable::factory()->count(100)->create();
        Booking::factory()->count(500)->create();
        Bookable::all()->each(function (Bookable $bookable){
           $reviews = Review::factory()->count(rand(5,30))->make();
           $bookable->reviews()->saveMany($reviews);
        });

    }
}
