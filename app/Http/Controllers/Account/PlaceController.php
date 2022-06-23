<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\CreateRequest;
use App\Http\Requests\Place\UpdateRequest;
use App\Models\City;
use App\Models\Image;
use App\Models\Place;
use App\Models\Transport;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    public function create()
    {
        return view('account.places.create', [
            'fieldsToCreate' => Place::getFieldsToCreate(),
            'linkedFields' => Place::getLinkedFields(),
            'linkedModelsWithoutImages' => Place::GetLinkedModelsWithoutImages(),
            'method' => 'store',
            'param' => null,
            'title' => 'Добавление',
        ]);
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        // сохраняю картинки
        foreach ($request->images as $image) {
            $imageData['url'] = app(UploadService::class)
                ->saveFile($image, 'images');
            $picture = Image::create($imageData);
            // создаю массив с идентификаторами
            $imagesIds[] = $picture->id;
            // в качестве главной картинки выбираю в произвольном порядке
            $data['main_picture_id'] = $imagesIds[array_rand($imagesIds, 1)];

        };
        $request->images = $imagesIds;
        // если такой город есть, присваиваю идентификатор , если нет создаю новый город
        $request->cities = City::query()->where('title', $data['cities'])
            ->firstOrCreate([
                'title' => $data['cities']
            ])->id;
        //закрепляю место за пользователем, который его создал
        $data['created_by_user_id'] = Auth::user()->getAuthIdentifier();
        $created = Place::create($data);
        if ($created) {

            //заполняю сводные таблицы
            foreach (Place::getLinkedFields() as $key => $item) {
                $created->$key()->attach($request->$key);
            }

            return redirect()->route('account.places', 'created')->with([
                'success' => __('messages.account.places.created.success'),
                'item' => $created->title

            ]);
        }
        return back()->with([
            'error' => __('messages.account.places.created.error'),
            'item' => $created->title
        ])->withInput();
    }

    public function edit(Place $place)
    {
        return view('account.places.create', [
            'fieldsToCreate' => Place::getFieldsToCreate(),
            'linkedFields' => Place::getLinkedFields(),
            'linkedModelsWithoutImages' => Place::GetLinkedModelsWithoutImages(),
            'place' => $place,
            'method' => 'update',
            'param' => $place,
            'title' => 'Обновление',
            'button' => 'Обновить'
        ]);
    }

    public function update(UpdateRequest $request, Place $place)
    {
        $data = $request->validated();
        // сохраняю картинки
        if ($request->images) {
            foreach ($request->images as $image) {
                $ImageData['url'] = app(UploadService::class)
                    ->saveFile($image, 'images');
                $picture = Image::create($ImageData);
                // создаю массив с идентификаторами
                $imagesIds[] = $picture->id;
            };
        }
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
        // в качестве главной картинки выбираю в произвольном порядке из загруженных
        $data['main_picture_id'] = $imagesIds[array_rand($imagesIds, 1)];

        $request->images = $imagesIds;
        // если такой город есть, присваиваю идентификатор, если нет создаю новый город
        $request->cities = City::query()->where('title', $data['cities'])
            ->firstOrCreate([
                'title' => $data['cities']
            ])->id;

        $updated = $place->fill($data)->save();

        if ($updated) {

            //заполняю сводные таблицы
            foreach (Place::getLinkedFields() as $key => $item) {
                $place->$key()->detach();
                $place->$key()->attach($request->$key);
            }

            return redirect()->route('account.places', 'created')->with([
                'success' => __('messages.account.places.updated.success'),
                'item' => $place->title

            ]);
        }

        return back()->with([
            'error' => __('messages.account.places.updated.error'),
            'item' => $place->title
        ])->withInput();
    }

    public function destroy(Place $place)
    {
        foreach ($place->images as $image) {
            app(UploadService::class)->deleteFile($image->url);
            $image->delete();
        }

        $deleted = $place->delete();
        if ($deleted) {

            return redirect()->route('account.places', 'created')->with([
                'success' => __('messages.account.places.deleted.success'),
                'item' => $place->title

            ]);
        }

        return back()->with([
            'error' => __('messages.account.places.deleted.error'),
            'item' => $place->title
        ])->withInput();
    }

}
