<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            CitySeeder::class,
            ImagesSeeder::class,
            PlaceSeeder::class,
            CitiesPlacesSeeder::class,
            PlacesImagesSeeder::class,
            PlacesLikesSeeder::class,
            CommentsSeeder::class,
            TransportsSeeder::class,
            PlacesTransportsSeeder::class,

        ]);
    }
}
