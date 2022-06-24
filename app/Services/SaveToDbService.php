<?php

namespace App\Services;

use App\Models\City;
use App\Models\Image;
use App\Models\Place;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaveToDbService
{
    public function saveParsedPlaceToDb(array $modelData, array $linkedData): Model|bool
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

    /**
     * @param Model $model
     * @param array $data
     * @return Model|bool
     */
    public function saveToDb(Model $model, array $data): Model|bool
    {
        if ($model->fill($data)->save()){
            return $model;
        }
        return false;
    }

    /**
     * @param array $data
     * @param Place|null $place
     * @return Model|bool
     */
    public function saveCreatedPlaceToDb(array $data, Place $place = null): Model|bool
    {
        // сохраняю картинки
        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $imageData['url'] = app(UploadService::class)
                    ->saveFile($image, 'images');
                $picture = Image::create($imageData);
                // создаю массив с идентификаторами
                $imagesIds[] = $picture->id;
            };
        }
        if($place){
            // удаляю не нужные картинки
            foreach ($place->images as $image) {
                if (in_array($image->id, explode(',', $data['deletedImages']))
                    && !str_starts_with($image->url, 'http')) {
                    app(UploadService::class)
                        ->deleteFile($image->url);
                } else {
                    $imagesIds[] = $image->id;
                }
            }
        }
        // в качестве главной картинки выбираю в произвольном порядке из загруженных
        $data['main_picture_id'] = $imagesIds[array_rand($imagesIds, 1)];
        $data['images'] = $imagesIds;
        // если такой город есть, присваиваю идентификатор , если нет создаю новый город
        $data['cities'] = City::query()->where('title', $data['cities'])
            ->firstOrCreate([
                'title' => $data['cities']
            ])->id;
        //закрепляю место за пользователем, который его создал
        $data['created_by_user_id'] = Auth::user()->getAuthIdentifier();

        if($place){
            $place->fill($data)->save();
            $savedPlace = $place;

        }else{
            $savedPlace = Place::create($data);

        }
        if ($savedPlace) {

            //заполняю сводные таблицы
            foreach (Place::getLinkedFields() as $key => $item) {
                if($place){
                    $savedPlace->$key()->detach();
                }
                $savedPlace->$key()->attach($data[$key]);
            }
            return $savedPlace;
        }
        return false;
    }

}
