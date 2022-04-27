<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesPlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('cities_places')->insert($this->getData());
    }

    private function getData()
    {
        $data = [
            [
                'city_id' => 1,
                'place_id' => 1
            ],
            [
                'city_id' => 1,
                'place_id' => 2
            ],
            [
                'city_id' => 1,
                'place_id' => 3
            ],
            [
                'city_id' => 2,
                'place_id' => 4
            ],
            [
                'city_id' => 2,
                'place_id' => 5
            ],
            [
                'city_id' => 2,
                'place_id' => 6
            ],
            [
                'city_id' => 5,
                'place_id' => 7
            ],
            [
                'city_id' => 1,
                'place_id' => 8
            ],
            [
                'city_id' => 1,
                'place_id' => 9
            ],
            [
                'city_id' => 1,
                'place_id' => 10
            ],


        ];

        return $data;
    }



}
