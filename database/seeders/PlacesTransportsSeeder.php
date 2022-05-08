<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacesTransportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places_transports')->insert([
            [
                'place_id' => 1,
                'transport_id' => 3,
            ],
            [
                'place_id' => 1,
                'transport_id' => 5,
            ],
            [
                'place_id' => 1,
                'transport_id' => 6,
            ],
            [
                'place_id' => 2,
                'transport_id' => 3,
            ],
            [
                'place_id' => 3,
                'transport_id' => 1,
            ],
            [
                'place_id' => 3,
                'transport_id' => 2,
            ],
            [
                'place_id' => 3,
                'transport_id' => 3,
            ],
            [
                'place_id' => 3,
                'transport_id' => 2,
            ],
            [
                'place_id' => 3,
                'transport_id' => 7,
            ],
            [
                'place_id' => 4,
                'transport_id' => 3,
            ],
            [
                'place_id' => 5,
                'transport_id' => 3,
            ],
            [
                'place_id' => 6,
                'transport_id' => 3,
            ],
            [
                'place_id' => 7,
                'transport_id' => 3,
            ],
            [
                'place_id' => 7,
                'transport_id' => 6,
            ],
            [
                'place_id' => 8,
                'transport_id' => 3,
            ],
            [
                'place_id' => 8,
                'transport_id' => 5,
            ],
            [
                'place_id' => 9,
                'transport_id' => 3,
            ],
            [
                'place_id' => 10,
                'transport_id' => 3,
            ],

        ]);

    }
}
