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
                'message' => $faker->sentence(10),
                'target_table_id' => 1,
                'target_id' => $faker->numberBetween(1,10),

            ];
        }
        return $data;
    }
}
