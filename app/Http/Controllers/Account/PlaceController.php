<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\CreateRequest;
use App\Http\Requests\Place\UpdateRequest;
use App\Models\City;
use App\Models\Image;
use App\Models\Place;
use App\Models\Transport;
use App\Services\SaveToDbService;
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
            'title' => 'Добавление',
        ]);
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $created = app(SaveToDbService::class)->saveCreatedPlaceToDb($request->validated());
        if ($created) {
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
        $updated = app(SaveToDbService::class)->saveCreatedPlaceToDb($data, $place);

        if ($updated) {
            return redirect()->route('account.places', 'created')->with([
                'success' => __('messages.account.places.updated.success'),
                'item' => $updated->title
            ]);
        }

        return back()->with([
            'error' => __('messages.account.places.updated.error'),
            'item' => $updated->title
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
