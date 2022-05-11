<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transports')->insert(
            [
                ['title' => 'пешком'],
                ['title' => 'общественный транспорт'],
                ['title' => 'автомобиль'],
                ['title' => 'самолет'],
                ['title' => 'поезд'],
                ['title' => 'автобус'],
                ['title' => 'велосипед'],
                ['title' => 'корабль'],

            ]

        );

    }
}
