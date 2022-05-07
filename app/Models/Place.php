<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'places';
    protected $fillable = [
        'title',
        'description',
        'coordinates',
    ];

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'cities_places',
            'place_id', 'city_id',
            'id', 'id'
        );
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'places_images',
            'place_id', 'image_id',
            'id', 'id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function getPlaces($filters)
    {
        return
            DB::table('cities_places as cp')
                ->join('cities as c', 'cp.city_id', '=', 'c.id')
                ->join('places as p', 'cp.place_id', '=', 'p.id')
                ->join('images as im', 'p.main_picture_id', '=', 'im.id')
                ->select('p.id as place_id', 'c.title as city', 'p.title', 'p.description', 'im.url as main_picture')
                ->when($filters['city'], function ($query, $city) {
                    return $query->having('city', $city);
                })
                ->get();
    }

    public static function getWhithFilters($page, $itemsPerPage, $filters)
    {
        return self::getPlaces($filters)->slice(($page - 1) * $itemsPerPage, $itemsPerPage);
    }
}
