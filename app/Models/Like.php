<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = [
        'place_id',
        'user_id',
        'session_token',
    ];

    public static function getInPlaces($placesId)
    {
        return
            DB::table('likes')
                ->groupBy('place_id')
                ->select('place_id')
                ->addSelect(DB::raw('count(*) as likes_count, place_id'))
                ->whereIn('place_id', $placesId)
                ->get();
    }
}
