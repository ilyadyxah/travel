<?php

namespace App\Services;

use App\Models\City;
use App\Models\Group;
use App\Models\Image;
use App\Models\Place;
use App\Models\Transport;
use App\Models\Type;
use \Illuminate\Database\Eloquent\Model;

class SaveToDbService
{
    public function SavePlaceToDb(array $modelData, array $linkedData): Model|bool
    {
        $model = Place::query()->firstOrCreate(['title' => $modelData['title']]);
        $model->fill($modelData);

        // создаю, связанные с местом, сущности, если таковых нет
        if ($model){
            $city = City::query()->firstOrCreate([
                'title' => $linkedData['cities']
            ]);
            $linkedData['cities'] = $city->id;

            $group = Group::query()->firstOrCreate([
                'title' =>  $linkedData['groups']
            ]);
            $linkedData['groups'] = $group->id;

            $type = Type::query()->firstOrCreate([
                'title' => $linkedData['types']
            ]);
            $linkedData['types'] = $type->id;

            $transport = Transport::query()->firstOrCreate([
                'title' => $linkedData['transports']
            ]);
            $linkedData['transports'] = $transport->id;
            $imageIds=[];

        // если есть картинки, то выбираю в случайном порядке из того, что есть
            foreach ($linkedData['images'] as $imageInfo){
                $image = Image::firstOrCreate([
                    'url' => 'https://russia.travel' . $imageInfo->image->src,
                ]);
                array_push($imageIds, $image->id);
            }
            if ($imageIds){
                $model->main_picture_id = $imageIds[array_rand($imageIds, 1)];
                $model->save();
            }

            $linkedData['images'] = $imageIds;
            //заполняю связанные таблицы
            foreach ($linkedData as $field => $linkedItem){
                if ($model->$field()){
                    $model->$field()->detach();
                    $model->$field()->attach($linkedItem);
                }
            }
            return $model;
        }
        return false;
    }

    public function SaveToDb(Model $model, array $data)
    {
        $model->fill($data)->save();
    }
}
