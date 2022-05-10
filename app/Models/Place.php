<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
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

    public static function getPlaces(): Builder
    {
        return
            DB::table('cities_places as cp')
                ->join('cities as c', 'cp.city_id', '=', 'c.id')
                ->join('places as p', 'cp.place_id', '=', 'p.id')
                ->join('images as im', 'p.main_picture_id', '=', 'im.id')
                ->join('places_transports as tr', 'cp.place_id', '=', 'tr.place_id')
                ->select(
                    'p.id as place_id',
                    'c.title as city',
                    'p.title',
                    'p.description',
                    'p.distance as distance',
                    'p.cost as cost',
                    'p.complexity as complexity',
                    'im.url as main_picture')
                ->addSelect(DB::raw("GROUP_CONCAT(tr.transport_id) as `transports`"));

    }


    public static function getWithFilters(array $filters): Collection
    {
        return
            self::getPlaces()
                ->when($filters['city'], function ($query, $city) {
                    return $query->having('city', $city);
                })
                ->when($filters['minDistance'],
                    function ($query, $minDistance) {
                        return $query->having('p.distance', '>', $minDistance);
                    })
                ->when($filters['maxDistance'],
                    function ($query, $maxDistance) {
                        return $query->having('p.distance', '<', $maxDistance);
                    })
                ->when($filters['minCost'],
                    function ($query, $minCost) {
                        return $query->having('p.cost', '>', $minCost);
                    })
                ->when($filters['maxCost'],
                    function ($query, $maxCost) {
                        return $query->having('p.cost', '<', $maxCost);
                    })
                ->when($filters['complexity'],
                    function ($query, $complexity) {
                        return $query->having('complexity', $complexity);
                    })
                ->when($filters['transport'],
                    function ($query, $transport) {
                        return $query->havingRaw('transports', $transport);
                    })
                ->groupBy('place_id')
                ->get();
    }

    public static function getWhithFiltersOnPage(int $page, int $itemsPerPage, array $filters): Collection
    {
        return self::getWithFilters($filters)->slice(($page - 1) * $itemsPerPage, $itemsPerPage);
    }
}
