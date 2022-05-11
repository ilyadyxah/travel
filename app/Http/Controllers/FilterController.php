<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FilterController
{
  public function getCityFilter(): Collection
  {
      return City::all()->pluck('title', 'id');
  }

    public function getTransportFilter(): Collection
    {
        return DB::table('transports')->get()->pluck('title', 'id');
    }
}
