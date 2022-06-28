<?php

namespace Database\Seeders;

use http\Client\Curl\User;
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
            FirstUserSeeder::class,
            CitySeeder::class,
            ImagesSeeder::class,
            PlaceSeeder::class,
            CitiesPlacesSeeder::class,
            PlacesImagesSeeder::class,
            PlacesLikesSeeder::class,
            TargetSeeder::class,
            CommentsSeeder::class,
            TransportsSeeder::class,
            PlacesTransportsSeeder::class,
            SourceSeeder::class,

        ]);
    }
}
