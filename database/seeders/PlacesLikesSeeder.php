<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PlacesLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('password'),
        ]);
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
