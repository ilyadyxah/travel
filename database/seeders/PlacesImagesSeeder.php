<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacesImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places_images')->insert([
            [   'place_id' => 1,
                'image_id' => 1,
            ],
            [   'place_id' => 1,
                'image_id' => 11,
            ],
            [   'place_id' => 1,
                'image_id' => 12,
            ],
            [   'place_id' => 2,
                'image_id' => 2,
            ],
            [   'place_id' => 2,
                'image_id' => 13,
            ],
            [   'place_id' => 2,
                'image_id' => 14,
            ],
            [   'place_id' => 3,
                'image_id' => 3,
            ],
            [   'place_id' => 3,
                'image_id' => 15,
            ],
            [   'place_id' => 3,
                'image_id' => 16,
            ],
            [   'place_id' => 4,
                'image_id' => 4,
            ],
            [   'place_id' => 4,
                'image_id' => 17,
            ],
            [   'place_id' => 4,
                'image_id' => 18,
            ],
            [   'place_id' => 5,
                'image_id' => 5,
            ],
            [   'place_id' => 5,
                'image_id' => 19,
            ],
            [   'place_id' => 5,
                'image_id' => 20,
            ],
            [   'place_id' => 6,
                'image_id' => 6,
            ],
            [   'place_id' => 6,
                'image_id' => 21,
            ],
            [   'place_id' => 6,
                'image_id' => 22,
            ],
            [  'place_id' => 7,
                'image_id' => 7,
            ],
            [  'place_id' => 7,
                'image_id' => 23,
            ],
            [  'place_id' => 7,
                'image_id' => 24,
            ],
            [   'place_id' => 8,
                'image_id' => 8,
            ],
            [   'place_id' => 8,
                'image_id' => 25,
            ],
            [   'place_id' => 8,
                'image_id' => 26,
            ],
            [   'place_id' => 9,
                'image_id' => 9,
            ],
            [   'place_id' => 9,
                'image_id' => 27,
            ],
            [   'place_id' => 9,
                'image_id' => 28,
            ],
            [   'place_id' => 10,
                'image_id' => 10,
            ],
            [   'place_id' => 10,
                'image_id' => 29,
            ],
            [   'place_id' => 10,
                'image_id' => 30,
            ],
        ]);

    }
}
