<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Group;
use App\Models\Image;
use App\Models\Place;
use App\Models\Transport;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use function PHPUnit\Framework\isEmpty;

class ParseController extends \Illuminate\Routing\Controller
{
    public function parse(Request $request)
    {

        $data = [];
        $linkedData = [];
        $startId = 284235;


        for ($i = 0; count($data) < $request->get('count'); $i++) {
            $id = $startId + $i;
            $parseData = file_get_contents($this->getUrl($id));
//получаю все данные
            if ($parseData = json_decode($parseData)->item) {
                $data[$id]['district'] = $parseData->district->name;
                $data[$id]['region'] = $parseData->region->name;
                $data[$id]['title'] = $parseData->title;
                $data[$id]['description'] = strip_tags($parseData->desc);
//                todo разобраться почему широта и долгота отображаются не корректно 
                $data[$id]['longitude'] = $parseData->geo->lat;
                $data[$id]['latitude'] = $parseData->geo->lon;

                $linkedData[$id]['types'] = $parseData->type[0]->name;
                $linkedData[$id]['groups'] = $parseData->group[0]->name;
                $linkedData[$id]['cities'] = $parseData->local->name ?? 'Россия';
                $linkedData[$id]['transports'] = isset($parseData->transports) ? $parseData->transports->name : 'пешком';
                $linkedData[$id]['images'] = $parseData->images;


            }
        }
        //сохраняю места, если их нет
        foreach ($data as $key => $item){
            $parsed = Place::query()->firstOrCreate(['title' => $item['title']]);
            $parsed->fill($item);

            // создаю, связанные с местом, сущности, если таковых нет
            if ($parsed){
                $city = City::query()->firstOrCreate([
                    'title' => $linkedData[$key]['cities']
                ]);
                $linkedData[$key]['cities'] = $city->id;

                $group = Group::query()->firstOrCreate([
                    'title' =>  $linkedData[$key]['groups']
                ]);
                $linkedData[$key]['groups'] = $group->id;


                $type = Type::query()->firstOrCreate([
                    'title' => $linkedData[$key]['types']
                ]);
                $linkedData[$key]['types'] = $type->id;

                $transport = Transport::query()->firstOrCreate([
                    'title' => $linkedData[$key]['transports']
                ]);
                $linkedData[$key]['transports'] = $transport->id;
                $imageIds=[];
                // если есть картинки, то выбираю в случайном порядке из того, что есть
                    foreach ($linkedData[$key]['images'] as $imageInfo){
                        $image = Image::firstOrCreate([
                            'url' => 'https://russia.travel' . $imageInfo->image->src,
                        ]);
                        array_push($imageIds,$image->id);
                    }
                    if ($imageIds){
                        $parsed->main_picture_id = $imageIds[array_rand($imageIds, 1)];
                        $parsed->save();
                    }

                $linkedData[$key]['images'] = $imageIds;
                    //заполняю связанные таблицы
                foreach ($linkedData[$key] as $field => $linkedItem){
                    if ($parsed->$field()){
                        $parsed->$field()->detach();
                        $parsed->$field()->attach($linkedItem);
                    }
                }
            }
        }

        return redirect()->route('account.profile' )->with([
            'success'=> __('messages.account.places.parsed.success'),
            'item' => count($data) . ' мест',

        ]);

//        return response()->json($data);
    }

    public function getUrl($id): string
    {
        return "https://api.russia.travel/api/travels/frontend/v3/json/rus/travel?id=$id";
    }
}
