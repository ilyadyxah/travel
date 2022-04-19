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
                'url' => 'https://museum-nt.ru/upload/iblock/79e/79ecaff574e9597e44210ddea54fa640.jpg'
            ],
            [   'place_id' => 2,
                'url' => 'https://uraloved.ru/images/mesta/sv-obl/bogdanovich/inopl-peizazh-bogdanovich-7.jpg'
            ],
            [   'place_id' => 3,
                'url' => 'https://ural-n.ru/uploads/topics/preview/00/00/00/39/6585ff0c20.jpg'
            ],
            [   'place_id' => 4,
                'url' => 'https://img-fotki.yandex.ru/get/9799/132998484.51/0_e790d_e690aa74_XXL.jpg'
            ],
            [   'place_id' => 5,
                'url' => 'https://i.pinimg.com/originals/c0/ad/5b/c0ad5bc7f156956b190a269fb23cb048.jpg'
            ],
            [   'place_id' => 6,
                'url' => 'http://uraloved.ru/images/mesta/chel-obl/kochkar/russkaya-braziliya-6.jpg'
            ],
            [   'place_id' => 7,
                'url' => 'http://510mln.ru/authors/diary/pics2016/2016_08_09_06055.jpg'
            ],
            [   'place_id' => 8,
                'url' => 'https://tn.fishki.net/26/upload/post/2019/12/08/3163682/5-scale-1200.jpg'
            ],
            [   'place_id' => 9,
                'url' => 'https://static.tildacdn.com/tild6334-6666-4261-b265-306462353733/145181725017376498.jpg'
            ],
            [   'place_id' => 10,
                'url' => 'http://www.adsl.kirov.ru/projects/articles/2020/12/05/plotina/0003.jpg'
            ],
        ]);

    }
}
