<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('comments')->insert($this->getData());

    }

    private function getData(): array
    {
        $faker = Factory::create();
        $commentsNum = 20;
        $data = [];

        for ($i = 1; $i <= $commentsNum; $i++){
            $data[] = [
                'place_id' => $faker->numberBetween(1,10),
                'user_name' => $faker->firstName() . ' ' . $faker->lastName(),
                'message' => $faker->sentence(10),
            ];
        }
        return $data;
    }
}
