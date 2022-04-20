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
                'title' => 'екатеринбург',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'челябинск',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'москва',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'санкт-петербург',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'тюмень',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'омск',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'новосибирск',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'краснодар',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'мурманск',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],
            [
                'title' => 'сочи',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",

            ],

        ];
        for ($i = 0; $i < count($data); $i++){
            $data[$i]['slug'] = Str::slug($data[$i]['title']);
        }
        return $data;
    }

}
