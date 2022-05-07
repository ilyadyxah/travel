<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'place_id',
        'user_id',
        'user_name',
        'message',
    ];

    public static function getInPlaces($placesId)
    {
        return
            DB::table('comments as c')
                ->select('c.place_id', 'c.user_name', 'c.message')
                ->whereIn('c.place_id', $placesId)
                ->get();
    }
}

