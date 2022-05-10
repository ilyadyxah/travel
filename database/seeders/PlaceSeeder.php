<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert($this->getData());
    }

    private function getData()
    {
        $data = [
            [
                'title' => 'Старый демидовский завод',
                'main_picture_id' => 1,
                'description' => 'С 1725 до 1917 гг. это действующий чугуноплавильный и железоделательный завод Демидовых, после 1917 года это Нижнетагильский металлургический завод им. В.В. Куйбышева.',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 150,
                'complexity' => 10,
                'cost' => 1000,

            ],
            [
                'title' => 'Уральский марс',
                'main_picture_id' => 2,
                'description' => 'Официальное название этого места довольно скучное — Полдневский участок Троицко-Байновского месторождения огнеупорных глин. Но это не важно, вы будете в восторге от необычного ландшафта, который так похож на «красную планету». Озера и глиняные борозды карьеров окрашены в красный и кирпичный — ну чем не Марс?',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 50,
                'complexity' => 50,
                'cost' => null,


            ],
            [
                'title' => 'Белая башня',
                'main_picture_id' => 3,
                'description' => 'Белая башня (бывшая водонапорная башня УЗТМ) — гидротехническое сооружение в Орджоникидзевском районе Екатеринбурга, памятник архитектуры конструктивизма, в настоящее время используется как культурная площадка.',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 20,
                'complexity' => 5,
                'cost' => null,


            ],
            [
                'title' => 'Национальный парк «Таганай»',
                'main_picture_id' => 4,
                'description' => 'Тут можно полюбоваться высокими горными хребтами и причудливыми каменными останцами, россыпями курумов и удивительной каменной рекой, вытянувшейся на несколько километров.',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 250,
                'complexity' => 50,
                'cost' => 1000,

            ],
            [
                'title' => 'Голубые озёра',
                'main_picture_id' => 5,
                'description' => 'Необычайной красоты места лежат на севере Пермского края, близ города Александровск – целая страна горных озёр, с водой насыщенно бирюзового цвета. Удивительно, но эти озёра всего лишь рукотворные сооружения – старые затопленные карьеры для добычи известняка.',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 100,
                'complexity' => 50,
                'cost' => null,



            ],
            [
                'title' => 'Русская "Бразилия" на Южном Урале',
                'main_picture_id' => 6,
                'description' => 'На этой территории расположено 6 действующих месторождений и около ста проявлений разных полезных ископаемых.',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 100,
                'complexity' => 50,
                'cost' => null,


            ],
            [
                'title' => 'Абалак',
                'main_picture_id' => 7,
                'description' => 'туристический комплекс близ города Тобольска, Тюменская область. Здесь воссоздана деревянная крепость, проходят реконструкции и праздники.',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 150,
                'complexity' => 10,
                'cost' => 500,

            ],
            [
                'title' => 'Алапаевская узкоколейная железная дорога',
                'main_picture_id' => 8,
                'description' => 'Алапаевская узкоколейная железная дорога (АУЖД) – самая протяженная пассажирская узкоколейная дорога России с шириной колеи 750 мм.',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 300,
                'complexity' => 50,
                'cost' => 1000,

            ],
            [
                'title' => 'Аракаевские пещеры',
                'main_picture_id' => 9,
                'description' => 'Эти пещеры расположены около села Аракаево (Свердловская область). Одна из них – самая протяженная пещера на реке Серге. Аракаевские пещеры находятся на территории популярного природного парка «Оленьи ручьи», однако в этой (южной) части парка туристов пока значительно меньше, чем в его центральной части около Бажуково.',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 200,
                'complexity' => 50,
                'cost' => null,


            ],
            [
                'title' => 'Плотина Верхне-Араслановского водохранилища',
                'main_picture_id' => 10,
                'description' => 'Верхне-Араслановское водохранилище строилось в 1990-е годы в верховьях реки Уфа. Из-за недостатка средств оно не было достроено. С тех пор близ села Белянка, чуть в стороне от реки Уфы, осталась стоять впечатляющая своими размерами недостроенная плотина. Внешним видом она напоминает инопланетный корабль из голливудского блокбастера.',
//                'coordinates' => "GeomFromText('POINT(37.774929 -122.419415)')",
                'distance' => 100,
                'complexity' => 50,
                'cost' => null,


            ],

        ];
        for ($i = 0; $i < count($data); $i++){
            $data[$i]['slug'] = Str::slug($data[$i]['title']);
        }
        return $data;
    }
}
