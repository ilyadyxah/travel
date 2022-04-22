<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert($this->getData());

    }

    private function getData()
    {
        $data = [
            [
                'title' => 'Екатеринбург',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'Челябинск',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'Москва',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'Санкт-Петербург',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'Тюмень',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'Омск',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'Новосибирск',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'Краснодар',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'Мурманск',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'Сочи',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],

        ];
        for ($i = 0; $i < count($data); $i++){
            $data[$i]['slug'] = Str::slug($data[$i]['title']);
        }
        return $data;
    }

}
