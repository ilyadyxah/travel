<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $fillable = [
        'url',
    ];

    /**
     * @return HasMany
     */
    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public static function getInPlaces($placesId)
    {
        return
            DB::table('places_images as pim')
                ->join('images', 'pim.image_id', '=', 'images.id')
                ->select('pim.place_id', 'images.url as image')
                ->whereIn('pim.place_id', $placesId)
                ->get();
    }
}
