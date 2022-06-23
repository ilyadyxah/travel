<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Place;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SaveToDbService
{
    public function SavePlaceToDb(array $modelData, array $linkedData): Model|bool
    {
        $model = Place::query()->firstOrCreate(['title' => $modelData['title']]);
        $model->fill($modelData);

        // создаю, связанные с местом, сущности, если таковых нет
        if ($model){
            foreach (Place::getLinkedFields() as $item => $cyrillic) {
                $item = DB::table($item)->firstOrCreate([
                    'title' => $linkedData[$item]
                ]);

                $linkedData[$item] = $item->id;
                if ($item === 'images'){
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
                    
                }
            }
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
