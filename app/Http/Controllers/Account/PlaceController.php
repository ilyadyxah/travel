<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\CreateRequest;
use App\Models\City;
use App\Models\Image;
use App\Models\Place;
use App\Models\Transport;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('account.places.create', [
            'fieldsToCreate' => Place::getFieldsToCreate(),
            'linkedFields' => Place::getLinkedFields(),
            'cities' => City::all(),
            'transports' => Transport::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {

        $data = $request->validated();
// сохраняю картинки
        foreach($request->images as $image){
            $ImageData['url'] = app(UploadService::class)
                ->saveFile($image, 'images');
            $picture = Image::create($ImageData);
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
        if($created){

            //заполняю сводные таблицы
            foreach (Place::getLinkedFields() as $key => $item){
                $created->$key()->attach($request->$key);
            }

            return redirect()->route('app::home')->with([
                'success' => __('messages.admin.products.created.success'),
                'item' => $created->title
            ]);
        }
        return back()->with([
            'error'=> __('messages.admin.products.created.error'),
            'item' => $created->title
        ])->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
