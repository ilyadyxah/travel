<?php

namespace App\Jobs;

use App\Models\City;
use App\Models\Group;
use App\Models\Image;
use App\Models\Place;
use App\Models\Source;
use App\Models\Transport;
use App\Models\Type;
use App\Services\SaveToDbService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function Couchbase\defaultDecoder;

class PlaceParseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Source $source;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Source $source)
    {
        $this->source = $source;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data = [];
        $linkedData = [];
        $id = $this->source->last_parsed_item_id ? ($this->source->last_parsed_item_id + 1) : 284235;
        $parseData = $this->getFirstItemWithImage($this->source, $id);

//        получаю все данные
        $id = (int) $parseData->id;
        if ($parseData) {
            $data['district'] = $parseData->district->name;
            $data['region'] = $parseData->region->name;
            $data['title'] = $parseData->title;
            $data['description'] = strip_tags($parseData->desc);
            $data['longitude'] = $parseData->geo->lon;
            $data['latitude'] = $parseData->geo->lat;

            $linkedData['types'] = $parseData->type[0]->name;
            $linkedData['groups'] = $parseData->group[0]->name;
            $linkedData['cities'] = $parseData->local->name ?? 'Россия';
            $linkedData['transports'] = isset($parseData->transports) ? $parseData->transports->name : 'пешком';
            $linkedData['images'] = $parseData->images;
        }

        if(app(SaveToDbService::class)->saveParsedPlaceToDb($data, $linkedData)){
            app(SaveToDbService::class)->saveToDb($this->source, [
                'last_parsed_item_id' => $id,
                'total_parsed_items' => ++$this->source->total_parsed_items
            ]);
        };

    }

    public function getFirstItemWithImage(Source $source, int $startId)
    {
        $raw = json_decode(file_get_contents($source->url . $startId))->item;
        if($raw and count($raw->images) > 0){
            return $raw;
        } else{
            return $this->getFirstItemWithImage($source, ++$startId);
        }

    }

}
