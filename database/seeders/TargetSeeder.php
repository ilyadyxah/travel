<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('targets')->insert([
            [
                'table' => 'places'
            ],
            [
                'table' => 'comments'
            ],
            [
                'table' => 'users'
            ],
            [
                'table' => 'cities'
            ],

        ]);

    }
}
