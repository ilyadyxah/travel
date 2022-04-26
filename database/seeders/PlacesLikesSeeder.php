<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacesLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->insert($this->getData());


    }

    private function getData(): array
    {
        $faker = Factory::create();
        $likesNum = 20;
        $data = [];

        for ($i = 1; $i <= $likesNum; $i++){
            $data[] = [
                'place_id' => $faker->numberBetween(1,6),

            ];
        }
        return $data;
    }
}
