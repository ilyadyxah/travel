<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function transports(): BelongsToMany
    {
        return $this->belongsToMany(Transport::class, 'places_transports',
            'place_id', 'transport_id',
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
     * @return HasMany
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

    public static function getWithFilters(array $filters, $filteredWithTransport = null): Collection|array
    {
        $places =
            Place::query()
                ->when($filters['minDistance'],
                    function ($query, $minDistance) {
                        return $query->where('distance', '>', $minDistance);
                    })
                ->when($filters['maxDistance'],
                    function ($query, $maxDistance) {
                        return $query->where('distance', '<', $maxDistance);
                    })
                ->when($filters['minCost'],
                    function ($query, $minCost) {
                        return $query->where('cost', '>', $minCost);
                    })
                ->when($filters['maxCost'],
                    function ($query, $maxCost) {
                        return $query->where('cost', '<', $maxCost);
                    })
                ->when($filters['complexity'],
                    function ($query, $complexity) {
                        return $query->where('complexity', $complexity);
                    })
                ->when($filteredWithTransport,
                    function ($query, $places_id) {
                        return $query->whereIn('id', $places_id);
                    })
                ->get();

        if ($filters['city']) {
            $places = $places->reject(function ($place) use ($filters) {
                return
                    $place->cities->first()->id != $filters['city'];
            });
        }

        if ($filters['transport']) {
            $places = $places->reject(function ($place) use ($filters) {
                return
                    !$place->transports->find($filters['transport']);
            });
        }

        return $places;
    }

    public static function getWhithFiltersOnPage(int $page, int $itemsPerPage, array $filters): mixed
    {
        return
            self::getWithFilters($filters)
                ->slice(($page - 1) * $itemsPerPage, $itemsPerPage);
    }

}
