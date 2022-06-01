<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreatedPlaceService
{
        public function getCreatedPlacesIds()
        {
            $createdPlacesId = [];
            if (Auth::check()){
                $data = DB::table('places')
                    ->where('created_by_user_id', Auth::user()->getAuthIdentifier())
                    ->get()->toArray();
                foreach ($data as $key => $value){
                    $createdPlacesId[] = $value->id;
                }
            }
            return $createdPlacesId;
        }
}
