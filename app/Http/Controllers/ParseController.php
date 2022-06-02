<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;

class ParseController extends \Illuminate\Routing\Controller
{
    public function parse(Request $request)
    {
        $count = $request->get('count');
        $data = [];
        $startId = 284235;

        for ($i = 0; $i < $count; $i++) {
            $id = $startId + $i;
            $parseData = file_get_contents($this->getUrl($id));
            if ($parseData = json_decode($parseData)->item) {
                $data[$id]['district'] = $parseData->district->name;
                $data[$id]['region'] = $parseData->region->name;
                $data[$id]['city'] = $parseData->local->name;
                $data[$id]['type'] = $parseData->type[0]->name;
                $data[$id]['group'] = $parseData->group[0]->name;
                $data[$id]['title'] = $parseData->title;
                $data[$id]['description'] = $parseData->desc;
                $data[$id]['longitude'] = $parseData->geo->lon;
                $data[$id]['latitude'] = $parseData->geo->lat;
            }
        }

        return response()->json($data);
    }

    public function getUrl($id): string
    {
        return "https://api.russia.travel/api/travels/frontend/v3/json/rus/travel?id=$id";
    }
}
